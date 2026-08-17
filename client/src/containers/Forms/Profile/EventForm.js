/**
 * Npm import
 */
import { connect } from 'react-redux';

/**
 * Local import
 */
import EventFrom from 'src/components/Forms/Profile/EventForm';
// Action Creators
import { setCurrentPictureEvent } from 'src/store/reducers/user';

const mapStateToProps = state => ({
  eventType: state.data.eventType,
  userPlaces: state.user.profile.places,
  initialValues: {
    place_id: state.user.profile.places[0].name,
    event_type_id: state.data.eventType[0].name,
  },
});

const mapDispatchToProps = dispatch => ({

  setCurrentPictureEvent: (picturePath) => {
    dispatch(setCurrentPictureEvent(picturePath));
  },
});
// Container
const PlaceFromContainer = connect(
  mapStateToProps,
  mapDispatchToProps,
)(EventFrom);


/**
 * Export
 */
export default PlaceFromContainer;
