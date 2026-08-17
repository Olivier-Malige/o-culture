/**
 * Npm import
 */
import { connect } from 'react-redux';

/**
 * Local import
 */
import Home from 'src/components/Home';

// Action Creators
const mapStateToProps = state => ({
  events: state.data.events,
  loggedUser: state.user.logged,
  userName: state.user.name,
});

const mapDispatchToProps = {};

// Container
const HomeContainer = connect(
  mapStateToProps,
  mapDispatchToProps,
)(Home);

/**
 * Export
 */
export default HomeContainer;
