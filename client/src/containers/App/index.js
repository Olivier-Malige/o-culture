/**
 * Npm import
 */
import { connect } from 'react-redux';
import { withRouter } from 'react-router-dom';
/**
 * Local import
 */
import App from 'src/components/App';
import { getEventsList, getPlacesList } from 'src/store/middlewares/dataAjax';
import { getProfile } from 'src/store/middlewares/userAjax';
import { loginUser } from 'src/store/reducers/user';

// Action Creators
const mapStateToProps = null;

// Actions
const mapDispatchToProps = dispatch => ({
  getEventsList: () => {
    dispatch(getEventsList());
  },
  loginUser: (values) => {
    dispatch(loginUser(values));
  },
  getUserProfile: () => {
    dispatch(getProfile());
  },
  getPlacesList: () => {
    dispatch(getPlacesList());
  },
});

// Container
const AppContainer = connect(
  mapStateToProps,
  mapDispatchToProps,
)(App);

/**
 * Export
 */
export default withRouter(AppContainer);
