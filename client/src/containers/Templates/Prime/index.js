/**
 * Npm import
 */
import { connect } from 'react-redux';

/**
 * Local import
 */
import Prime from 'src/components/Templates/Prime';

// Action Creators
const mapStateToProps = state => ({
  list: state.Prime.list,
});

const mapDispatchToProps = {};

// Container
const PrimeConnectionContainer = connect(
  mapStateToProps,
  mapDispatchToProps,
)(Prime);

/**
 * Export
 */
export default PrimeConnectionContainer;
