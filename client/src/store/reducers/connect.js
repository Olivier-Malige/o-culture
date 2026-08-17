/**
 * Initial State
 */
const initialState = {
  signupShow: false,
  loginShow: false,
  loginError: '',
  signupAcount: 'spectator',
  page: 1,
};
/**
 * Types
 */
const SPECTATOR_SIGNUP = 'SHOW_SPECTATOR_SIGNUP';
const ARTIST_SIGNUP = 'SHOW_ARTIST_SIGNUP';
const ORGANIZER_SIGNUP = 'SHOW_PLACE_SIGNUP';
const RESET_ALL = 'RESET_ALL';
const SET_ACOUNT = 'SET_ACOUNT';
const SET_LOGIN = 'SET_LOGIN';
const SET_LOGIN_ERROR = 'SET_LOGIN_ERROR';
const SET_SIGNUP = 'SET_SIGNUP';
const SIGN_UP_NEXT_PAGE = 'SIGN_UP_NEXT_PAGE';
const SIGN_UP_PREV_PAGE = 'SIGN_UP_PREV_PAGE';

/**
 * Traitements
 */

/**
 * Reducer
 */
const reducer = (state = initialState, action = {}) => {
  switch (action.type) {
    case SET_LOGIN:
      return {
        ...state,
        loginError: '',
        signupShow: false,
        loginShow: true,
      };
    case SET_LOGIN_ERROR:
      return {
        ...state,
        loginError: action.value,
      };
    case SET_SIGNUP:
      return {
        ...state,
        signupShow: true,
        loginShow: false,
      };
    case SPECTATOR_SIGNUP:
      return {
        ...state,
        signupShow: true,
        loginShow: false,
        signupAcount: 'spectator',
      };
    case ARTIST_SIGNUP:
      return {
        ...state,
        signupShow: true,
        loginShow: false,
        signupAcount: 'artist',
      };
    case ORGANIZER_SIGNUP:
      return {
        ...state,
        signupShow: true,
        loginShow: false,
        signupAcount: 'organizer',
      };
    case RESET_ALL:
      return {
        ...state,
        page: 1,
        signupShow: false,
        loginShow: false,
        signupAcount: 'spectator',
      };
    case SET_ACOUNT:
      return {
        ...state,
        signupAcount: action.value,
      };
    case SIGN_UP_NEXT_PAGE:
      return {
        ...state,
        page: state.page + 1,
      };
    case SIGN_UP_PREV_PAGE:
      return {
        ...state,
        page: state.page - 1,
      };

    default:
      return state;
  }
};

/**
 * Action Creators
 */
export const spectatorSignup = () => ({
  type: SPECTATOR_SIGNUP,
});
export const artistSignup = () => ({
  type: ARTIST_SIGNUP,
});
export const organizerSignup = () => ({
  type: ORGANIZER_SIGNUP,
});
export const closeForm = () => ({
  type: RESET_ALL,
});
export const setAcount = value => ({
  type: SET_ACOUNT,
  value,
});
export const setLogin = () => ({
  type: SET_LOGIN,
});
export const setLoginError = value => ({
  type: SET_LOGIN_ERROR,
  value,
});
export const setSignup = () => ({
  type: SET_SIGNUP,
});

export const nextPage = () => ({
  type: SIGN_UP_NEXT_PAGE,
});
export const prevPage = () => ({
  type: SIGN_UP_PREV_PAGE,
});

/**
 * Selectors
 */

/**
 * Export
 */
export default reducer;
