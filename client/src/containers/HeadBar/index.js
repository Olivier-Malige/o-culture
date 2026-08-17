/**
 * Npm import
 */
import { connect } from 'react-redux';

/**
 * Local import
 */
import HeadBar from 'src/components/HeadBar';
// Action Creators
import { setSignup, setLogin } from 'src/store/reducers/connect';
import { logoutUser } from 'src/store/reducers/user';

const mapStateToProps = state => ({
  signupShow: state.connect.signupShow,
  loginShow: state.connect.loginShow,
  loggedUser: state.user.logged,
  userInitial: state.user.name.charAt(0),
});

const mapDispatchToProps = dispatch => ({
  setSignup: () => {
    dispatch(setSignup());
  },
  setLogin: () => {
    dispatch(setLogin());
  },

  logoutUser: () => {
    dispatch(logoutUser());
    localStorage.removeItem('token');
  },
});

// Container
const HeadBarContainer = connect(
  mapStateToProps,
  mapDispatchToProps,
)(HeadBar);


/**
 * Export
 */
export default HeadBarContainer;
