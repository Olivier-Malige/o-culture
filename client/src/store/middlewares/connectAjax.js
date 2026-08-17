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
const POST_LOGOUT = 'POST_LOGOUT';
const CHECK_MAIL_EXIST = 'CHECK_MAIL_EXIST';
const CHECK_USERNAME_EXIST = 'CHECK_USERNAME_EXIST';

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
          // console.log('signup response :', response);
          if (response.data.error === 0
            && response.data.status === true
            && response.status === 200) {
            store.dispatch(closeForm());
            store.dispatch(setLogin());
            // console.log('signup done');
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
          // console.log(response.data);
          localStorage.setItem('token', response.data.token);
          // console.log(jwt());
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
    case CHECK_MAIL_EXIST:
      server.api
        .post('/api/searchByEmail', action.value)
        .then((response) => {
          // console.log(response.data);
        })
        .catch((error) => {
          // console.error(error);
        });
      break;
    case CHECK_USERNAME_EXIST:
      server.api
        .post('/api/searchByUsername', action.value)
        .then((response) => {
          // console.log(response.data);
        })
        .catch((error) => {
          // console.error(error);
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
export const sendLogout = () => ({
  type: POST_LOGOUT,
});
export const checkMailExist = value => ({
  type: CHECK_MAIL_EXIST,
  value,
});
export const checkUserNameExist = value => ({
  type: CHECK_USERNAME_EXIST,
  value,
});

/**
 * Export
 */
export default connectAjax;
