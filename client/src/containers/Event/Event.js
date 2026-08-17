/**
 * Npm import
 */
import { connect } from 'react-redux';

/**
 * Local import
 */
import Event from 'src/components/Event';
import { getEvent } from 'src/store/middlewares/dataAjax';
import { followEvent } from 'src/store/middlewares/userAjax';
import { setLogin } from 'src/store/reducers/connect';

// Action Creators
const mapStateToProps = (state) => {
  const followed = state.user.profile
    && (state.user.profile._events_participant
      || state.user.profile.events_participant
      || state.user.profile.EventsParticipant);
  const followedEvents = Array.isArray(followed)
    ? followed
    : (followed && typeof followed === 'object' ? Object.values(followed) : []);
  return {
    currentEvent: state.data.currentEvent,
    comments: state.data.currentEvent.comments || [],
    userLogged: state.user.logged,
    isFollowing: followedEvents.some(event => event.id === state.data.currentEvent.id),
  };
};

const mapDispatchToProps = dispatch => ({
  followEvent: id => dispatch(followEvent(id)),
  getCurrentEvent: (id) => {
    dispatch(getEvent(id));
  },
  setLogin: () => {
    dispatch(setLogin());
  },
});

// Container
const EventContainer = connect(
  mapStateToProps,
  mapDispatchToProps,
)(Event);

/**
 * Export
 */
export default EventContainer;
