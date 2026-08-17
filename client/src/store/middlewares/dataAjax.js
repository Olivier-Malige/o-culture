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
  artistsReceived,
  artistReceived,
  artistEventsReceived,
  zipcodeReceived,
  monthlyEventsReceived,
  eventsByType,
} from 'src/store/reducers/data';
/**
 * Local import
 */

/**
  * Types
  */
// Settings
const GET_ARTISTS_LIST = 'GET_ARTISTS_LIST';
const GET_ARTIST = 'GET_ARTIST';
const GET_ARTIST_EVENTS = 'GET_ARTIST_EVENTS';
const GET_EVENTS_LIST = 'GET_EVENTS_LIST';
const GET_EVENT = 'GET_EVENT';
const GET_PLACES_LIST = 'GET_PLACES_LIST';
const GET_PLACE = 'GET_PLACE';
const GET_RESULTS_EVENTS = 'GET_RESULTS_EVENTS';
const GET_RESULTS_ARTISTS = 'GET_RESULTS_ARTISTS';
const GET_RESULTS_PLACES = 'GET_RESULTS_PLACES';
const GET_PLACE_TYPE = 'GET_PLACE_TYPE';
const GET_EVENT_TYPE = 'GET_EVENT_TYPE';
const GET_EVENTS_ZIPCODE = 'GET_EVENTS_ZIPCODE';
const GET_MONTHLY_EVENTS = 'GET_MONTHLY_EVENTS';
const GET_EVENTS_BY_TYPE = 'GET_EVENTS_BY_TYPE';

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
    case GET_ARTISTS_LIST:
      server.api
        .get('/api/artists')
        .then((response) => {
          // console.log(response.data);
          store.dispatch(artistsReceived(response.data));
        })
        .catch((error) => {
          console.error(error);
        });
      break;
    case GET_ARTIST:
      server.api
        .get(`/api/artists/${action.id}`)
        .then((response) => {
          // console.log(response.data);
          store.dispatch(artistReceived(response.data));
        })
        .catch((error) => {
          console.error(error);
        });
      break;
    case GET_ARTIST_EVENTS:
      server.api
        .get(`/api/artists/${action.id}/events`)
        .then((response) => {
          // console.log(response.data);
          store.dispatch(artistEventsReceived(response.data));
        })
        .catch((error) => {
          console.error(error);
        });
      break;
    case GET_EVENTS_LIST:
      server.api
        .get('/api/events')
        .then((response) => {
          // console.log(response.data);
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
          // console.log(response.data);
          store.dispatch(eventReceived(response.data));
          // get recommendation
          const place = response.data.event_place;
          if (place && place.zipcode) {
            const zipcode = place.zipcode.toString().slice(0, 2);
            store.dispatch(getEventsZipcode(zipcode));
          }
          /**
           * FIX:
           * error city, find why
           * 
           */
          // store.dispatch(getArtistEvents(artist));
        })
        .catch((error) => {
          console.error(error);
        });
      break;
    case GET_PLACES_LIST:
      server.api
        .get('/api/places')
        .then((response) => {
          // console.log(response.data);
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
          // console.log(response.data);
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
          // console.log(response.data);
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
          // console.log(response.data);
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
          // console.log(response.data);
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
          // console.log(response.data);
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
          // console.log(response.data);
          dispatchSearchList(store, action.value, response.data, resultsPlacesReceived);
        })
        .catch((error) => {
          console.error(error);
        });
      break;
    case GET_EVENTS_ZIPCODE:
      server.api
        .get(`/api/zipcode/${action.value}/events`)
        .then((response) => {
          // console.log(response.data);
          store.dispatch(zipcodeReceived(response.data));
        })
        .catch((error) => {
          console.error(error);
        });
      break;
    case GET_MONTHLY_EVENTS:
      server.api
        .get(`/api/events/date/${action.year}-${action.month}`)
        .then((response) => {
          // console.log(response.data);
          store.dispatch(monthlyEventsReceived(response.data));
        })
        .catch((error) => {
          console.error(error);
        });
      break;
    case GET_EVENTS_BY_TYPE:
      server.api
        .get(`/api/type/${action.value}/events`)
        .then((response) => {
          // console.log(response.data);
          store.dispatch(eventsByType(action.value, response.data));
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
export const getArtistsList = () => ({
  type: GET_ARTISTS_LIST,
});
export const getArtist = id => ({
  type: GET_ARTIST,
  id,
});
export const getArtistEvents = id => ({
  type: GET_ARTIST_EVENTS,
  id,
});
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
export const getEventsZipcode = value => ({
  type: GET_EVENTS_ZIPCODE,
  value,
});
export const getMonthlyEvents = (year, month) => ({
  type: GET_MONTHLY_EVENTS,
  year,
  month,
});
export const getEventsByType = value => ({
  type: GET_EVENTS_BY_TYPE,
  value,
});

/**
 * Export
 */
export default dataAjax;
