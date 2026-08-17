/**
 * Npm import
 */
import { connect } from 'react-redux';

/**
 * Local import
 */
import Search from 'src/components/HeadBar/Search';
import { getResultsEvents, getResultsArtists, getResultsPlaces } from 'src/store/middlewares/dataAjax';

import { searchInput } from 'src/store/reducers/data';

// Action Creators
const mapStateToProps = state => ({
  query: state.data.search.query,
  results: state.data.search.results,
});

const mapDispatchToProps = dispatch => ({
  onInputChange: (value) => {
    dispatch(searchInput(value));
    // if (value && value.length > 1) {
    if (value) {
      dispatch(getResultsEvents(value));
      dispatch(getResultsArtists(value));
      dispatch(getResultsPlaces(value));
    }
  },
});

// Container
const SearchContainer = connect(
  mapStateToProps,
  mapDispatchToProps,
)(Search);

/**
 * Export
 */
export default SearchContainer;
