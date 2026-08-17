/**
 * Initial State
 */
const initialState = {
  events: [],
  placeType: [],
  eventType: [],
  currentEvent: {
    name: '',
    planned_date: '',
    nb_spectator: '',
    price: '',
    description: '',
    image: '',
    app_user_creator: {
      name: '',
    },
    event_place: {
      name: '',
      adress: '',
      city: '',
      zipcode: '',
      email: '',
    },
    event_type: {
      name: '',
    },
    comments: [
      {
        id: '',
        content: '',
        _app_user: {
          name: '',
        },
      },
    ],
    _app_user_performer: [
      {
        name: '',
      },
    ],
  },
  artists: '',
  places: '',
  currentPlace: {
    id: '',
    name: '',
    siret: '',
    adress: '',
    city: '',
    zipcode: '',
    email: '',
    description: '',
    website: '',
    image: '',
    events: [
      {
        name: '',
        planned_date: '',
        price: '',
        image: '',
        _app_user_performer: [
          {
            name: '',
          },
        ],
      },
    ],
    comments: [
      {
        id: '',
        content: '',
        created_at: '',
        _app_user: {
          username: '',
        },
      },
    ],
    _place_type: {
      name: '',
    },
  },
  search: {
    query: '',
    results: {
      artists: '',
      events: '',
      places: '',
    },
  },

};
/**
 * Types
 */
const INPUT_SEARCH = 'INPUT_SEARCH';
const SET_EVENTS = 'SET_EVENTS';
const SET_EVENT = 'SET_EVENT';
const SET_PLACES = 'SET_PLACES';
const SET_PLACE = 'SET_PLACE';
const SET_ARTISTS = 'SET_ARTISTS';
const SET_ARTIST = 'SET_ARTIST';
const SET_ARTIST_EVENTS = 'SET_ARTIST_EVENTS';
const SET_EVENTS_RESULTS = 'SET_EVENTS_RESULTS';
const SET_ARTISTS_RESULTS = 'SET_ARTISTS_RESULTS';
const SET_PLACES_RESULTS = 'SET_PLACES_RESULTS';
const SET_PLACE_TYPE = 'SET_PLACE_TYPE';
const SET_EVENT_TYPE = 'SET_EVENT_TYPE';
const SET_ZIPCODE = 'SET_ZIPCODE';
const SET_MONTHLY_EVENTS = 'SET_MONTHLY_EVENTS';
const SET_EVENTS_BY_TYPE = 'SET_EVENTS_BY_TYPE';

/**
 * Traitements
 */

/**
 * Reducer
 */
const reducer = (state = initialState, action = {}) => {
  switch (action.type) {
    case SET_EVENTS:
      return {
        ...state,
        events: action.value,
      };
    case SET_EVENT:
      return {
        ...state,
        currentEvent: action.value,
      };
    case SET_PLACES:
      return {
        ...state,
        places: action.value,
      };
    case SET_PLACE:
      return {
        ...state,
        currentPlace: action.value,
      };
    case SET_ARTISTS:
      return {
        ...state,
        artists: action.value,
      };
    case SET_ARTIST:
      return {
        ...state,
        artist: action.value,
      };
    case SET_ARTIST_EVENTS:
      return {
        ...state,
        recommendation: { ...state.recommendation, artist_events: action.value },
      };
    case SET_PLACE_TYPE:
      return {
        ...state,
        placeType: action.value,
      };
    case SET_EVENT_TYPE:
      return {
        ...state,
        eventType: action.value,
      };
    // SEARCH ENGINE
    case INPUT_SEARCH:
      return {
        ...state,
        search: { ...state.search, query: action.value },
      };
    case SET_EVENTS_RESULTS:
      return {
        ...state,
        search: { ...state.search, results: { ...state.search.results, events: action.value } },
      };
    case SET_ARTISTS_RESULTS:
      return {
        ...state,
        search: { ...state.search, results: { ...state.search.results, artists: action.value } },
      };
    case SET_PLACES_RESULTS:
      return {
        ...state,
        search: { ...state.search, results: { ...state.search.results, places: action.value } },
      };
    case SET_ZIPCODE:
      return {
        ...state,
        recommendation: { ...state.recommendation, zipcode: action.value },
      };
    case SET_MONTHLY_EVENTS:
      return {
        ...state,
        recommendation: { ...state.recommendation, monthly_events: action.value },
      };
    case SET_EVENTS_BY_TYPE:
      return {
        ...state,
        recommendation: {
          ...state.recommendation,
          [action.value]: action.data,
        },
      };
    default:
      return state;
  }
};
/**
 * Action Creators
 */
export const searchInput = value => ({
  type: INPUT_SEARCH,
  value,
});
export const eventsReceived = value => ({
  type: SET_EVENTS,
  value,
});
export const eventReceived = value => ({
  type: SET_EVENT,
  value,
});
export const placesReceived = value => ({
  type: SET_PLACES,
  value,
});
export const placeReceived = value => ({
  type: SET_PLACE,
  value,
});
export const placeTypeReceived = value => ({
  type: SET_PLACE_TYPE,
  value,
});
export const eventTypeReceived = value => ({
  type: SET_EVENT_TYPE,
  value,
});
export const artistsReceived = value => ({
  type: SET_ARTISTS,
  value,
});
export const artistReceived = value => ({
  type: SET_ARTIST,
  value,
});
export const artistEventsReceived = value => ({
  type: SET_ARTIST_EVENTS,
  value,
});
export const resultsEventsReceived = value => ({
  type: SET_EVENTS_RESULTS,
  value,
});
export const resultsArtistsReceived = value => ({
  type: SET_ARTISTS_RESULTS,
  value,
});
export const resultsPlacesReceived = value => ({
  type: SET_PLACES_RESULTS,
  value,
});
export const zipcodeReceived = value => ({
  type: SET_ZIPCODE,
  value,
});
export const monthlyEventsReceived = value => ({
  type: SET_MONTHLY_EVENTS,
  value,
});
export const eventsByType = (value, data) => ({
  type: SET_EVENTS_BY_TYPE,
  value,
  data,
});

/**
 * Selectors
 */

/**
 * Export
 */
export default reducer;
