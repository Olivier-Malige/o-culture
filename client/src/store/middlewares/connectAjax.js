/**
 * npm import
 */
import Server from 'src/utils/server';
// Actions
import { setLogin, closeForm, setLoginError } from 'src/store/reducers/connect';
import { loginUser } from 'src/store/reducers/user';
import { getProfile } from 'src/store/middlewares/userAjax';
/**
 * Local import
 */
import jwt from 'src/utils/jwt';
/**
  * Types
  */
// Settings
const POST_SIGNUP = 'POST_SIGNUP';
const POST_LOGIN = 'POST_LOGIN';

/**
 * Code
 */
const server = new Server();
const connectAjax = store => next => (action) => {
  switch (action.type) {
    case POST_SIGNUP:
      server.api
        .post('/api/registration', action.value)
        .then((response) => {
          if (response.data.error === 0
            && response.data.status === true
            && response.status === 200) {
            store.dispatch(closeForm());
            store.dispatch(setLogin());
          }
        })
        .catch((error) => {
          console.error('signup error :', error);
        });
      break;
    case POST_LOGIN:
      server.api
        .post('/api/login_check', action.values)
        .then((response) => {
          localStorage.setItem('token', response.data.token);
          store.dispatch(loginUser(jwt(response.data.token)));
          store.dispatch(getProfile());
          // close login form
          store.dispatch(closeForm());
        })
        .catch((error) => {
          console.error('signin error :', error);
          store.dispatch(setLoginError('Email ou mot de passe incorrect '));
        });
      break;

    default:
      break;
  }
  return next(action);
};
/**
 * Action Creators
 */
export const sendLogin = values => ({
  type: POST_LOGIN,
  values,
});
export const sendSignup = value => ({
  type: POST_SIGNUP,
  value,
});

/**
 * Export
 */
export default connectAjax;
