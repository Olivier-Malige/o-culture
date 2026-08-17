/**
 * Import
 */
import React from 'react';
import PropTypes from 'prop-types';
/**
 * Local import
 */
// Composants
import SignupForm from 'src/containers/Forms/Connection/SignupForm';
import LoginForm from 'src/containers/Forms/Connection/LoginForm';
import LeftSide from './LeftSide';

// Styles et assets
import './connection.sass';

/**
 * Code
 */
const Connection = ({
  signupShow,
  loginShow,
  acount,
  sendLogin,
}) => {
  const loginSubmit = (values) => {
    sendLogin(values);
  };

  // set type for the  LeftSide : login, spectator, artitst, organizer
  const type = (loginShow) ? 'login' : acount;
  // and set appropriate background for LeftSide
  let background = '';
  if (type === 'spectator') {
    background = '/src/assets/1.jpg';
  }
  else if (type === 'artist') {
    background = '/src/assets/artist.jpg';
  }
  else if (type === 'organizer') {
    background = '/src/assets/organizer.jpg';
  }
  else if (type === 'login') {
    background = '/src/assets/login.jpg';
  }

  return (
    <div className="connection-container">
      <LeftSide
        background={background}
        type={type}
      />
      {(loginShow === true) && (
        <LoginForm
          onSubmit={loginSubmit}
        />
      )}
      {signupShow === true && (
        <SignupForm />
      )}
    </div>
  );
};

Connection.propTypes = {
  acount: PropTypes.string.isRequired,
  sendLogin: PropTypes.func.isRequired,
  signupShow: PropTypes.bool.isRequired,
  loginShow: PropTypes.bool.isRequired,
};

/**
 * Export
 */
export default Connection;
