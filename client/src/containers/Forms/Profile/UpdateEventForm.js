/**
 * Npm import
 */
import { connect } from 'react-redux';

/**
 * Local import
 */
import UpdateEventFrom from 'src/components/Forms/Profile/UpdateEventForm';
// Action Creators
import { getEventType } from 'src/store/middlewares/dataAjax';
import { setCurrentPictureEvent } from 'src/store/reducers/user';

const mapStateToProps = state => ({
  eventType: state.data.eventType,
  userPlaces: state.user.profile.places,
  initialValues: state.user.currentEvent,
});

const mapDispatchToProps = dispatch => ({

  getEventType: () => {
    dispatch(getEventType());
  },
  setCurrentPictureEvent: (picturePath) => {
    dispatch(setCurrentPictureEvent(picturePath));
  },

});
// Container
const UpdateEventFromContainer = connect(
  mapStateToProps,
  mapDispatchToProps,
)(UpdateEventFrom);


/**
 * Export
 */
export default UpdateEventFromContainer;
