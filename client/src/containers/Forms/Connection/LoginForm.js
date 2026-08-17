/**
 * Npm import
 */
import { connect } from 'react-redux';

/**
 * Local import
 */
import LoginForm from 'src/components/Forms/Connection/LoginForm';
// Action Creators
import {
  closeForm,
  setSignup,
} from 'src/store/reducers/connect';

import { sendLogin } from 'src/store/middlewares/connectAjax';

const mapStateToProps = state => ({
  loginError: state.connect.loginError,
});

const mapDispatchToProps = dispatch => ({
  onClose: () => {
    dispatch(closeForm());
  },
  sendLogin: (values) => {
    dispatch(sendLogin(values));
  },
  setSignup: () => {
    dispatch(setSignup());
  },
});

// Container
const LoginFormContainer = connect(
  mapStateToProps,
  mapDispatchToProps,
)(LoginForm);


/**
 * Export
 */
export default LoginFormContainer;
