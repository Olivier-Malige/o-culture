/**
 * Initial State
 */
const initialState = {
  name: '',
  acount: '',
  logged: false,
  profile: {},
  id: '',
  updateEvent: false,
  updatePlace: false,
  updateProfile: false,
  createEvent: false,
  createPlace: false,
  currentEvent: {},
  currentPlace: {},
};
/**
 * Types
 */
const SET_LOGGED = 'SET_LOGGED';
const SET_LOGOUT = 'SET_LOGOUT';
const SET_CURRENT_PLACE = 'SET_CURRENT_PLACE';
const SET_CURRENT_EVENT = 'SET_CURRENT_EVENT';
const SET_PROFILE = 'SET_PROFILE';
const SHOW_UPDATE_EVENT = 'SHOW_UPDATE_EVENT';
const SHOW_UPDATE_PLACE = 'SHOW_UPDATE_PLACE';
const SHOW_UPDATE_PROFILE = 'SHOW_UPDATE_PROFILE';
const SHOW_CREATE_EVENT = 'SHOW_CREATE_EVENT';
const SHOW_CREATE_PLACE = 'SHOW_CREATE_PLACE';
const CLOSE_FORM = 'CLOSE_FORM';
const SET_CURRENT_PICTURE_EVENT = 'SET_CURRENT_PICTURE_EVENT';
const SET_CURRENT_PICTURE_PLACE = 'SET_CURRENT_PICTURE_PLACE';
/**
 * Traitements
 */

/**
 * Reducer
 */

const reducer = (state = initialState, action = {}) => {
  switch (action.type) {
    case SET_LOGGED: {
      // Set appropriate role from jwt token
      let role;
      switch (action.values.role) {
        case 'ROLE_SPECTATOR':
        case 'ROLE_USER':
          role = 'spectator';
          break;
        case 'ROLE_ARTIST':
          role = 'artist';
          break;
        case 'ROLE_ORGANIZER':
          role = 'organizer';
          break;
        default:
          role = '';
          break;
      }
      return {
        ...state,
        name: action.values.username,
        id: action.values.id,
        logged: true,
        acount: role,
      };
    }
    case SET_LOGOUT:

      return {
        ...state,
        profile: {},
        name: '',
        id: '',
        acount: '',
        logged: false,
      };

    case SET_CURRENT_PLACE:
      return {
        ...state,
        currentPlace: action.value,
      };
    case SET_CURRENT_EVENT:
      return {
        ...state,
        currentEvent: action.value,
      };
    case SET_CURRENT_PICTURE_EVENT:
      return {
        ...state,
        currentPictureEvent: action.picture,
      };
    case SET_CURRENT_PICTURE_PLACE:
      return {
        ...state,
        currentPicturePlace: action.picture,
      };

    case SET_PROFILE:
      return {
        ...state,
        profile: action.values,
      };
    case SHOW_UPDATE_EVENT:
      return {
        ...state,
        updateEvent: true,
        updatePlace: false,
        createEvent: false,
        createPlace: false,
        updateProfile: false,
      };
    case SHOW_UPDATE_PLACE:
      return {
        ...state,
        updateEvent: false,
        updatePlace: true,
        createEvent: false,
        createPlace: false,
        updateProfile: false,
      };
    case CLOSE_FORM:
      return {
        ...state,
        updateEvent: false,
        updatePlace: false,
        createEvent: false,
        createPlace: false,
        updateProfile: false,
      };
    case SHOW_CREATE_EVENT:
      return {
        ...state,
        updateEvent: false,
        updatePlace: false,
        createEvent: true,
        createPlace: false,
        updateProfile: false,
      };
    case SHOW_CREATE_PLACE:
      return {
        ...state,
        updateEvent: false,
        updatePlace: false,
        createEvent: false,
        createPlace: true,
        updateProfile: false,
      };
    case SHOW_UPDATE_PROFILE:
      return {
        ...state,
        updateEvent: false,
        updatePlace: false,
        createEvent: false,
        createPlace: false,
        updateProfile: true,
      };
    default:
      return state;
  }
};

/**
 * Action Creators
 */
export const loginUser = values => ({
  type: SET_LOGGED,
  values,
});
export const logoutUser = values => ({
  type: SET_LOGOUT,
  values,
});
export const setUserProfile = values => ({
  type: SET_PROFILE,
  values,
});
export const showUpdateEvent = () => ({
  type: SHOW_UPDATE_EVENT,
});
export const showUpdatePlace = () => ({
  type: SHOW_UPDATE_PLACE,
});
export const setCurrentUpdatePlace = value => ({
  type: SET_CURRENT_PLACE,
  value,
});
export const setCurrentUpdateEvent = value => ({
  type: SET_CURRENT_EVENT,
  value,
});
export const setCurrentPictureEvent = picture => ({
  type: SET_CURRENT_PICTURE_EVENT,
  picture,
});
export const setCurrentPicturePlace = picture => ({
  type: SET_CURRENT_PICTURE_PLACE,
  picture,
});
export const showCreateEvent = () => ({
  type: SHOW_CREATE_EVENT,
});
export const showCreatePlace = () => ({
  type: SHOW_CREATE_PLACE,
});
export const showUpdateProfile = () => ({
  type: SHOW_UPDATE_PROFILE,
});
export const closeForm = () => ({
  type: CLOSE_FORM,
});

/**
 * Selectors
 */

/**
 * Export
 */
export default reducer;
