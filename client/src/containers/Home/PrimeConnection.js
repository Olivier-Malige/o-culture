/**
 * Npm import
 */
import { connect } from 'react-redux';

/**
 * Local import
 */
import PrimeConnection from 'src/components/Home/PrimeConnection';

// Action Creators
import { spectatorSignup, artistSignup, organizerSignup } from 'src/store/reducers/connect';

const mapStateToProps = state => ({
  showConnection: state.connect.show,
});

const mapDispatchToProps = dispatch => ({

  spectatorSignup: () => {
    dispatch(spectatorSignup());
  },

  artistSignup: () => {
    dispatch(artistSignup());
  },

  organizerSignup: () => {
    dispatch(organizerSignup());
  },

});

// Container
const PrimeConnectionContainer = connect(
  mapStateToProps,
  mapDispatchToProps,
)(PrimeConnection);


/**
 * Export
 */
export default PrimeConnectionContainer;
