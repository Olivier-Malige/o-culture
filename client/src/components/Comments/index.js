/**
 * Import
 */
import React from 'react';
import PropTypes from 'prop-types';

/**
 * Local import
 */
// Components
import Comment from './Comment';

// Styles and assets
import './comment.sass';

/**
 * Code
 */
class Comments extends React.Component {
  // set ref for value of the textarea comment
  textInput = React.createRef();

  handleSubmit = (evt) => {
    const { pageId, pageType } = this.props;
    evt.preventDefault();
    const { submit } = this.props;
    submit(this.textInput.current.value, pageId, pageType);
    this.textInput.current.value = '';
  }

  render() {
    const { comments, userLogged, setLogin } = this.props;
    // console.log(this.state);
    return (
      <React.Fragment>
        <div className="comment">
          {comments.map(comment => (
            <Comment
              key={comment.id}
              {...comment}
            />
          ))}
        </div>
        {userLogged
          ? (
            <form onSubmit={this.handleSubmit}>
              <div>
                <h3>Poster un commentaire</h3>
                <div>
                  <textarea ref={this.textInput} />
                </div>
                <button type="submit" className="comment-submit">
                  Envoyer
                </button>
              </div>
            </form>
          ) : (
            <div>
              <span className="connection" onClick={setLogin}>
                Connectez-vous
              </span>
              &nbsp;pour laisser un commentaire
            </div>
          )
        }
      </React.Fragment>
    );
  }
}

Comments.propTypes = {
  comments: PropTypes.array.isRequired,
  setLogin: PropTypes.func.isRequired,
};

/**
 * Export
 */
// export default Comments;
export default Comments;
