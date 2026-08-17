/**
 * Import
 */

import React from 'react';
import { Link, withRouter } from 'react-router-dom';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import PropTypes from 'prop-types';
/**
 * Local import
 */

// Composants
import Connection from 'src/containers/Forms/Connection';
import Search from 'src/containers/HeadBar/Search';
// Styles et assets
import './headBar.sass';

/**
 * Code
 */
class HeadBar extends React.Component {
  static propTypes = {
    signupShow: PropTypes.bool.isRequired,
    loginShow: PropTypes.bool.isRequired,
    loggedUser: PropTypes.bool.isRequired,
    setSignup: PropTypes.func.isRequired,
    logoutUser: PropTypes.func.isRequired,
    setLogin: PropTypes.func.isRequired,
    history: PropTypes.object.isRequired,
    userInitial: PropTypes.string.isRequired,
  };

  handleSubmit = (evt) => {
    if (evt) {
      evt.preventDefault();
    }
    this.props.history.push('/search');
  }

  render() {
    const {
      signupShow,
      setSignup,
      loggedUser,
      setLogin,
      loginShow,
      logoutUser,
      history,
      userInitial,
    } = this.props;
    return (
      <header>
        {(signupShow === true || loginShow === true) && (
          <Connection />
        )}
        <div className="search">
          <div className="search_wrapper">
            <Link to="/">
              <div className="search-logo">
                O'
              </div>
            </Link>
            <Search
              submit={this.handleSubmit}
            />
            <div className="search-settings" />
            {loggedUser === true && (
              <Link to="/profile">

                <div
                  className="search-settings-profil"
                >
                  <div className="search-settings-profil--picture">
                    {userInitial}
                  </div>
                </div>
              </Link>
            )}
            {loggedUser === false && (
              <div className="search-icon">
                <FontAwesomeIcon icon="user-plus" size="lg" onClick={setSignup} />
              </div>
            )}
            {loggedUser === false && (
              <div className="search-icon">
                <FontAwesomeIcon icon="sign-in-alt" size="lg" onClick={setLogin} />
              </div>
            )}
            {loggedUser === true && (
              <div className="search-icon">
                <FontAwesomeIcon
                  icon="sign-out-alt"
                  size="lg"
                  onClick={() => {
                    logoutUser();
                    // Redirect to home
                    history.push('/');
                  }}
                />
              </div>
            )}
            <div className="curtain" />
          </div>
        </div>
      </header>
    );
  }
}

/**
* Export
*/
export default withRouter(HeadBar);
