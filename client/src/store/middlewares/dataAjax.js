/**
 * npm import
 */
import Server from 'src/utils/server';
// Actions
import {
  eventsReceived,
  eventReceived,
  placesReceived,
  placeReceived,
  resultsEventsReceived,
  resultsArtistsReceived,
  resultsPlacesReceived,
  placeTypeReceived,
  eventTypeReceived,
} from 'src/store/reducers/data';
/**
 * Local import
 */

/**
  * Types
  */
// Settings
const GET_EVENTS_LIST = 'GET_EVENTS_LIST';
const GET_EVENT = 'GET_EVENT';
const GET_PLACES_LIST = 'GET_PLACES_LIST';
const GET_PLACE = 'GET_PLACE';
const GET_RESULTS_EVENTS = 'GET_RESULTS_EVENTS';
const GET_RESULTS_ARTISTS = 'GET_RESULTS_ARTISTS';
const GET_RESULTS_PLACES = 'GET_RESULTS_PLACES';
const GET_PLACE_TYPE = 'GET_PLACE_TYPE';
const GET_EVENT_TYPE = 'GET_EVENT_TYPE';

/**
 * Code
 */
const server = new Server();

/**
 * Keep only array payloads that still match the current search query.
 */
const dispatchSearchList = (store, query, data, actionCreator) => {
  if (query !== store.getState().data.search.query.trim()) {
    return;
  }
  store.dispatch(actionCreator(Array.isArray(data) ? data : []));
};

const dataAjax = store => next => (action) => {
  switch (action.type) {
    case GET_EVENTS_LIST:
      server.api
        .get('/api/events')
        .then((response) => {
          store.dispatch(eventsReceived(response.data));
        })
        .catch((error) => {
          console.error(error);
        });
      break;
    case GET_EVENT:
      server.api
        .get(`/api/events/${action.id}`)
        .then((response) => {
          store.dispatch(eventReceived(response.data));
        })
        .catch((error) => {
          console.error(error);
        });
      break;
    case GET_PLACES_LIST:
      server.api
        .get('/api/places')
        .then((response) => {
          store.dispatch(placesReceived(response.data));
        })
        .catch((error) => {
          console.error(error);
        });
      break;
    case GET_PLACE:
      server.api
        .get(`/api/places/${action.id}`)
        .then((response) => {
          store.dispatch(placeReceived(response.data));
        })
        .catch((error) => {
          console.error(error);
        });
      break;
    case GET_PLACE_TYPE:
      server.api
        .get('/api/placetypes')
        .then((response) => {
          store.dispatch(placeTypeReceived(response.data));
        })
        .catch((error) => {
          console.error(error);
        });
      break;
    case GET_EVENT_TYPE:
      server.api
        .get('/api/eventtypes')
        .then((response) => {
          store.dispatch(eventTypeReceived(response.data));
        })
        .catch((error) => {
          console.error(error);
        });
      break;
    case GET_RESULTS_EVENTS:
      server.api
        .post('/api/events/search', {
          search: action.value,
        })
        .then((response) => {
          dispatchSearchList(store, action.value, response.data, resultsEventsReceived);
        })
        .catch((error) => {
          console.error(error);
        });
      break;
    case GET_RESULTS_ARTISTS:
      server.api
        .post('/api/artists/search', {
          search: action.value,
        })
        .then((response) => {
          dispatchSearchList(store, action.value, response.data, resultsArtistsReceived);
        })
        .catch((error) => {
          console.error(error);
        });
      break;
    case GET_RESULTS_PLACES:
      server.api
        .post('/api/places/search', {
          search: action.value,
        })
        .then((response) => {
          dispatchSearchList(store, action.value, response.data, resultsPlacesReceived);
        })
        .catch((error) => {
          console.error(error);
        });
      break;

    default:
      break;
  }
  return next(action);
};
/**
 * Action Creators
 */
export const getEventsList = () => ({
  type: GET_EVENTS_LIST,
});
export const getEvent = id => ({
  type: GET_EVENT,
  id,
});
export const getPlace = id => ({
  type: GET_PLACE,
  id,
});
export const getPlacesList = () => ({
  type: GET_PLACES_LIST,
});
export const getPlaceType = () => ({
  type: GET_PLACE_TYPE,
});
export const getEventType = () => ({
  type: GET_EVENT_TYPE,
});
export const getResultsEvents = value => ({
  type: GET_RESULTS_EVENTS,
  value,
});
export const getResultsArtists = value => ({
  type: GET_RESULTS_ARTISTS,
  value,
});
export const getResultsPlaces = value => ({
  type: GET_RESULTS_PLACES,
  value,
});

/**
 * Export
 */
export default dataAjax;
