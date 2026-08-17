/**
 * Npm import
 */
import { connect } from 'react-redux';

/**
 * Local import
 */
import Comments from 'src/components/Comments';
import { addCommentEvent, addCommentPlace } from 'src/store/middlewares/userAjax';
import { setLogin } from 'src/store/reducers/connect';


// Action Creators
const mapStateToProps = state => ({
  userLogged: state.user.logged,
});

const mapDispatchToProps = dispatch => ({
  submit: (value, id, pageType) => {
    if (pageType === 'Event') {
      dispatch(addCommentEvent(value, id));
    }
    else if (pageType === 'Comment') {
      dispatch(addCommentPlace(value, id));
    }
  },
  setLogin: () => {
    dispatch(setLogin());
  },
});

// Container
const CommentsContainer = connect(
  mapStateToProps,
  mapDispatchToProps,
)(Comments);

/**
 * Export
 */
export default CommentsContainer;
