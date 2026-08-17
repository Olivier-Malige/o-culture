/**
 * Npm import
 */
import { connect } from 'react-redux';

/**
 * Local import
 */
import Connection from 'src/components/Forms/Connection';
// Action Creators

import { sendLogin } from 'src/store/middlewares/connectAjax';

const mapStateToProps = state => ({
  acount: state.connect.signupAcount,
  signupShow: state.connect.signupShow,
  loginShow: state.connect.loginShow,
});

const mapDispatchToProps = dispatch => ({

  sendLogin: (form) => {
    dispatch(sendLogin(form));
  },
});

// Container
const ConnectionContainer = connect(
  mapStateToProps,
  mapDispatchToProps,
)(Connection);


/**
 * Export
 */
export default ConnectionContainer;
