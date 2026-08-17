/**
 * Npm import
 */
import { connect } from 'react-redux';

/**
 * Local import
 */
import Search from 'src/components/HeadBar/Search';
import { getResultsEvents, getResultsArtists, getResultsPlaces } from 'src/store/middlewares/dataAjax';
import { searchInput, resultsEventsReceived, resultsArtistsReceived, resultsPlacesReceived } from 'src/store/reducers/data';

let searchTimer;

const mapStateToProps = state => ({
  query: state.data.search.query,
  results: state.data.search.results,
});

const mapDispatchToProps = dispatch => ({
  onInputChange: (value) => {
    dispatch(searchInput(value));
    window.clearTimeout(searchTimer);
    const query = value.trim();
    if (query.length < 2) {
      dispatch(resultsEventsReceived([]));
      dispatch(resultsArtistsReceived([]));
      dispatch(resultsPlacesReceived([]));
      return;
    }
    searchTimer = window.setTimeout(() => {
      dispatch(getResultsEvents(query));
      dispatch(getResultsArtists(query));
      dispatch(getResultsPlaces(query));
    }, 300);
  },
});

const SearchContainer = connect(
  mapStateToProps,
  mapDispatchToProps,
)(Search);

export default SearchContainer;
