/**
 * Import
 */
import React from 'react';
/**
 * Local import
 */
// Composants

// Styles et assets

/**
 * Code
 */
const Comment = comment => (
  <React.Fragment>
    <div>
      <span className="comment-author">
        {comment._app_user && (comment._app_user.name || comment._app_user.username)}
      </span>
    </div>
    <p className="comment-text">{comment.content}</p>
  </React.Fragment>
);

/**
 * Export
 */
export default Comment;
