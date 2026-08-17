/**
 * Npm import
 */
import { connect } from 'react-redux';

/**
 * Local import
 */
import SignupForm from 'src/components/Forms/Connection/SignupForm';
// Action Creators
import {
  closeForm,
  setAcount,
  nextPage,
  prevPage,
  setLogin,
} from 'src/store/reducers/connect';

import { sendSignup } from 'src/store/middlewares/connectAjax';

const mapStateToProps = state => ({
  acount: state.connect.signupAcount,
  initialValues: {
    acount: state.connect.signupAcount,
  },
  page: state.connect.page,
});

const mapDispatchToProps = dispatch => ({
  onClose: () => {
    dispatch(closeForm());
  },
  selectAcount: (acount) => {
    dispatch(setAcount(acount));
  },
  sendSignup: (form) => {
    dispatch(sendSignup(form));
  },
  nextPage: () => {
    dispatch(nextPage());
  },
  prevPage: () => {
    dispatch(prevPage());
  },
  setLogin: () => {
    dispatch(setLogin());
  },
});

// Container
const SignupFormContainer = connect(
  mapStateToProps,
  mapDispatchToProps,
)(SignupForm);


/**
 * Export
 */
export default SignupFormContainer;
