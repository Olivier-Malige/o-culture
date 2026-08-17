/**
 * Npm import
 */
import { connect } from 'react-redux';

/**
 * Local import
 */
import Place from 'src/components/Place';
import { getPlace } from 'src/store/middlewares/dataAjax';

// Action Creators
const mapStateToProps = state => (
  {
    currentPlace: state.data.currentPlace,
    events: state.data.currentPlace.events,
    comments: state.data.currentPlace.comments || [],
  }
);

const mapDispatchToProps = dispatch => ({
  getPlace: (id) => {
    dispatch(getPlace(id));
  },
});

// Container
const PlaceContainer = connect(
  mapStateToProps,
  mapDispatchToProps,
)(Place);

/**
 * Export
 */
export default PlaceContainer;
