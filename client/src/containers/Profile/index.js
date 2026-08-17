/**
 * Npm import
 */
import { connect } from 'react-redux';
/**
 * Local import
 */
import Profile from 'src/components/Profile/';
// Action Creators
import { getEventType } from 'src/store/middlewares/dataAjax';
import {
  getProfile,
  createPlace,
  createEvent,
  deleteEvent,
  deletePlace,
  updateProfile,
  updateEvent,
  updatePlace,
} from 'src/store/middlewares/userAjax';

import {
  showUpdateEvent,
  showUpdatePlace,
  setCurrentUpdatePlace,
  setCurrentUpdateEvent,
  closeForm,
  showCreateEvent,
  showCreatePlace,
  showUpdateProfile,
  setCurrentPictureEvent,
  setCurrentPicturePlace,
} from 'src/store/reducers/user';

/** Normalize API collections that JMS may serialize as objects. */
const asList = (value) => {
  if (Array.isArray(value)) {
    return value;
  }
  if (value && typeof value === 'object') {
    return Object.values(value);
  }
  return [];
};

const mapStateToProps = state => ({
  userName: state.user.name,
  acount: state.user.acount,
  userEvents: asList(state.user.profile && state.user.profile.events),
  userPlaces: asList(state.user.profile && state.user.profile.places),
  userFollowEvents: asList(
    state.user.profile
    && (state.user.profile._events_participant
      || state.user.profile.events_participant
      || state.user.profile.EventsParticipant),
  ),
  isUpdateEvent: state.user.updateEvent,
  isUpdatePlace: state.user.updatePlace,
  isCreateEvent: state.user.createEvent,
  isCreatePlace: state.user.createPlace,
  isUpdateProfile: state.user.updateProfile,
  currentEvent: state.user.currentEvent,
  currentPlace: state.user.currentPlace,
  currentPictureEvent: state.user.currentPictureEvent,
  currentPicturePlace: state.user.currentPicturePlace,
});

const mapDispatchToProps = dispatch => ({

  getUserProfile: () => {
    dispatch(getProfile());
  },
  submitUpdateProfile: (values) => {
    dispatch(updateProfile(values));
    dispatch(closeForm());
  },
  submitCreatePlace: (values) => {
    dispatch(createPlace(values));
    dispatch(closeForm());
  },
  submitCreateEvent: (values) => {
    dispatch(createEvent(values));
    dispatch(closeForm());
  },
  submitUpdatePlace: (id) => {
    dispatch(updatePlace(id));
    dispatch(closeForm());
  },
  submitUpdateEvent: (id) => {
    dispatch(updateEvent(id));
    dispatch(closeForm());
  },
  deleteEvent: (id) => {
    dispatch(deleteEvent(id));
  },
  deletePlace: (id) => {
    dispatch(deletePlace(id));
  },
  showUpdateEvent: () => {
    dispatch(showUpdateEvent());
  },
  showUpdatePlace: () => {
    dispatch(showUpdatePlace());
  },
  setCurrentUpdatePlace: (values) => {
    dispatch(setCurrentUpdatePlace(values));
  },
  setCurrentUpdateEvent: (values) => {
    dispatch(setCurrentUpdateEvent(values));
  },
  setCurrentPictureEvent: (picture) => {
    dispatch(setCurrentPictureEvent(picture));
  },
  setCurrentPicturePlace: (picture) => {
    dispatch(setCurrentPicturePlace(picture));
  },
  showCreateEvent: () => {
    dispatch(showCreateEvent());
  },
  showCreatePlace: () => {
    dispatch(showCreatePlace());
  },
  showUpdateProfile: () => {
    dispatch(showUpdateProfile());
  },
  closeForm: () => {
    dispatch(closeForm());
  },
  getEventType: () => {
    dispatch(getEventType());
  },

});

// Container
const ProfileContainer = connect(
  mapStateToProps,
  mapDispatchToProps,
)(Profile);


/**
 * Export
 */
export default ProfileContainer;
