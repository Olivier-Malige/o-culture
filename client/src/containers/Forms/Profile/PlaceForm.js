/**
 * Npm import
 */
import { connect } from 'react-redux';

/**
 * Local import
 */
import PlaceFrom from 'src/components/Forms/Profile/PlaceForm';

// Action Creators
import { getPlaceType } from 'src/store/middlewares/dataAjax';
import { setCurrentPicturePlace } from 'src/store/reducers/user';

const mapStateToProps = state => ({
  placeType: state.data.placeType,
  initialValues: {
    event_type_id: state.data.eventType[0].name,
  },
});

const mapDispatchToProps = dispatch => ({

  getPlaceType: () => {
    dispatch(getPlaceType());
  },
  setCurrentPicturePlace: (picturePath) => {
    dispatch(setCurrentPicturePlace(picturePath));
  },
});

// Container
const PlaceFromContainer = connect(
  mapStateToProps,
  mapDispatchToProps,
)(PlaceFrom);


/**
 * Export
 */
export default PlaceFromContainer;
