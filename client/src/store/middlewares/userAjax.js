/**
 * npm import
 */
import axios from 'axios';
// Actions

import { setUserProfile } from 'src/store/reducers/user';
import { getEvent, getPlace } from 'src/store/middlewares/dataAjax';
/**
 * Local import
 */
import { serverUrl } from 'src/utils/server';
/**
  * Types
  */
// Settings
const GET_PROFILE = 'GET_PROFILE';
const UPDATE_PROFILE = 'UPDATE_PROFILE';
const UPDATE_PLACE = 'UPDATE_PLACE';
const CREATE_PLACE = 'CREATE_PLACE';
const DELETE_PLACE = 'DELETE_PLACE';
const UPDATE_EVENT = 'UPDATE_EVENT';
const CREATE_EVENT = 'CREATE_EVENT';
const DELETE_EVENT = 'DELETE_EVENT';
const FOLLOW_EVENT = 'FOLLOW_EVENT';
const ADD_COMMENT_EVENT = 'ADD_COMMENT_EVENT';
const ADD_COMMENT_PLACE = 'ADD_COMMENT_PLACE';
/**
 * Action Creators
 */
export const getProfile = () => ({
  type: GET_PROFILE,
});
export const updateProfile = values => ({
  type: UPDATE_PROFILE,
  values,
});
export const updatePlace = values => ({
  type: UPDATE_PLACE,
  values,
});
export const createPlace = values => ({
  type: CREATE_PLACE,
  values,
});
export const deletePlace = id => ({
  type: DELETE_PLACE,
  id,
});
export const updateEvent = values => ({
  type: UPDATE_EVENT,
  values,
});
export const createEvent = values => ({
  type: CREATE_EVENT,
  values,
});
export const deleteEvent = id => ({
  type: DELETE_EVENT,
  id,
});
export const addCommentEvent = (value, id) => ({
  type: ADD_COMMENT_EVENT,
  value,
  id,
});
export const addCommentPlace = (value, id) => ({
  type: ADD_COMMENT_PLACE,
  value,
  id,
});
export const followEvent = id => ({
  type: FOLLOW_EVENT,
  id,
});

/**
 * Code
 */
const ajax = store => next => (action) => {
  switch (action.type) {
    case GET_PROFILE: {
      const token = localStorage.getItem('token');
      if (!token) {
        break;
      }
      axios({
        method: 'get',
        url: `${serverUrl}/api/me`,
        headers: {
          Authorization: `Bearer ${token}`,
        },
      })
        .then((response) => {
          store.dispatch(setUserProfile(response.data));
        })
        .catch(error => console.error(error));
      break;
    }
    case UPDATE_PROFILE:
      axios({
        method: 'put',
        url: `${serverUrl}/api/appusers/${action.values.username}`,
        data: action.values,
        headers: {
          Authorization: `Bearer ${localStorage.getItem('token')}`,
        },
      })
        .then(() => {
          store.dispatch(getProfile());
        });
      break;
    case UPDATE_PLACE:
      axios({
        method: 'put',
        url: `${serverUrl}/api/places/${action.values.id}/update`,
        data: action.values,
        headers: {
          Authorization: `Bearer ${localStorage.getItem('token')}`,
        },
      })
        .then(() => {
          store.dispatch(getProfile());
        });
      break;
    case CREATE_PLACE:
      axios({
        method: 'post',
        url: `${serverUrl}/api/places/create`,
        data: action.values,
        headers: {
          Authorization: `Bearer ${localStorage.getItem('token')}`,
        },
      })
        .then(() => {
          store.dispatch(getProfile());
        });
      break;
    case DELETE_PLACE:
      axios({
        method: 'delete',
        url: `${serverUrl}/api/places/${action.id}/delete`,
        headers: {
          Authorization: `Bearer ${localStorage.getItem('token')}`,
        },
      })
        .then(() => {
          store.dispatch(getProfile());
        });
      break;
    case UPDATE_EVENT:
      axios({
        method: 'put',
        url: `${serverUrl}/api/events/${action.values.id}/update`,
        data: action.values,
        headers: {
          Authorization: `Bearer ${localStorage.getItem('token')}`,
        },
      })
        .then(() => {
          store.dispatch(getProfile());
        });
      break;
    case CREATE_EVENT:
      axios({
        method: 'post',
        url: `${serverUrl}/api/events/create`,
        data: action.values,
        headers: {
          Authorization: `Bearer ${localStorage.getItem('token')}`,
        },
      })
        .then(() => {
          store.dispatch(getProfile());
        });
      break;
    case DELETE_EVENT:
      axios({
        method: 'delete',
        url: `${serverUrl}/api/events/${action.id}/delete`,
        headers: {
          Authorization: `Bearer ${localStorage.getItem('token')}`,
        },
      })
        .then(() => {
          store.dispatch(getProfile());
        });
      break;
    case ADD_COMMENT_EVENT:
      axios({
        method: 'post',
        url: `${serverUrl}/api/events/${action.id}/comments`,
        data: {
          content: action.value,
        },
        headers: {
          Authorization: `Bearer ${localStorage.getItem('token')}`,
        },
      })
        .then(() => {
          store.dispatch(getEvent(action.id));
        })
        .catch(error => console.error(error));
      break;
    case ADD_COMMENT_PLACE:
      axios({
        method: 'post',
        url: `${serverUrl}/api/places/${action.id}/comments`,
        data: {
          content: action.value,
        },
        headers: {
          Authorization: `Bearer ${localStorage.getItem('token')}`,
        },
      })
        .then(() => {
          store.dispatch(getPlace(action.id));
        })
        .catch(error => console.error(error));
      break;
    case FOLLOW_EVENT: {
      next(action);
      return axios({
        method: 'post',
        url: `${serverUrl}/api/events/${action.id}/participate`,
        data: {},
        headers: {
          Authorization: `Bearer ${localStorage.getItem('token')}`,
        },
      })
        .then(() => {
          store.dispatch(getEvent(action.id));
          return store.dispatch(getProfile());
        })
        .catch((error) => {
          console.error(error);
          return Promise.reject(error);
        });
    }
    default:
      break;
  }
  return next(action);
};
/**
 * Export
 */
export default ajax;
