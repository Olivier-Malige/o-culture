/**
 * Npm import
 */
import { connect } from 'react-redux';

/**
 * Local import
 */
import ProfileFrom from 'src/components/Forms/Profile/ProfileForm';

// Action Creators

const mapStateToProps = state => ({
  acount: state.user.acount,
  initialValues: state.user.profile,
});

const mapDispatchToProps = {};

// Container
const ProfileFormContainer = connect(
  mapStateToProps,
  mapDispatchToProps,
)(ProfileFrom);


/**
 * Export
 */
export default ProfileFormContainer;
