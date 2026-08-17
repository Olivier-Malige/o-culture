/**
 * Npm import
 */
import { connect } from 'react-redux';

/**
 * Local import
 */
import UpdatePlaceFrom from 'src/components/Forms/Profile/UpdatePlaceForm';

// Action Creators
import { getPlaceType } from 'src/store/middlewares/dataAjax';
import { setCurrentPicturePlace } from 'src/store/reducers/user';

const mapStateToProps = state => ({
  placeType: state.data.placeType,
  initialValues: state.user.currentPlace,
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
const UpdatePlaceFromContainer = connect(
  mapStateToProps,
  mapDispatchToProps,
)(UpdatePlaceFrom);


/**
 * Export
 */
export default UpdatePlaceFromContainer;
