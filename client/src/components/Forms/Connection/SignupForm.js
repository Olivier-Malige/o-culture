/**
 * Import
 */
import React from 'react';
import PropTypes from 'prop-types';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';

/**
 * Local import
 */

import WizardFormFirstPage from './WizardFormFirstPage';
import WizardFormSecondPage from './WizardFormSecondPage';
import WizardFormThirdPage from './WizardFormThirdPage';

// Styles et assets
import './connection.sass';

/**
 * Code
 */
// this wizard form is divided into 3 pages
// and adapted according to the type of subscription
// prevPage and nextPage is use to change the current page in Redux
// acount is the type of subscription
const signupForm = ({
  onClose,
  acount,
  selectAcount,
  setLogin,
  page,
  prevPage,
  nextPage,
  sendSignup,
  initialValues,
}) => {
  const signupSubmit = (values) => {
    // Call redux function that send signup to the server with Axios
    console.warn('signupSubmit', values);
    sendSignup(values);
  };
  return (
    <div className="connection-form animated fast fadeInRight">
      <FontAwesomeIcon icon="times" className="connection-form-close" onClick={onClose} />
      <div className="connection-form-container">
        <div className="connection-form-container-field">
          {page === 1 && (
            <WizardFormFirstPage
              onSubmit={nextPage}
              selectAcount={selectAcount}
              initialValues={initialValues}
              setLogin={setLogin}
            />
          )}
          {page === 2 && acount === 'spectator' && (
            <WizardFormSecondPage
              acount={acount}
              prevPage={prevPage}
              onSubmit={signupSubmit}
              initialValues={initialValues}
            />
          )}
          {page === 2 && (acount === 'artist' || acount === 'organizer') && (
            <WizardFormSecondPage
              acount={acount}
              prevPage={prevPage}
              onSubmit={nextPage}
              initialValues={initialValues}
            />
          )}
          {page === 3 && (acount === 'artist' || acount === 'organizer') && (
            <WizardFormThirdPage
              acount={acount}
              prevPage={prevPage}
              onSubmit={signupSubmit}
              initialValues={initialValues}
            />
          )}
          <div className="connection-form-signin">
            <p>Vous avez déjà un compte ? <span onClick={setLogin}>Connexion</span></p>
          </div>
        </div>
      </div>
    </div>
  );
};

signupForm.propTypes = {
  initialValues: PropTypes.object.isRequired,
  acount: PropTypes.string.isRequired,
  page: PropTypes.number.isRequired,
  prevPage: PropTypes.func.isRequired,
  nextPage: PropTypes.func.isRequired,
  sendSignup: PropTypes.func.isRequired,
  onClose: PropTypes.func.isRequired,
  setLogin: PropTypes.func.isRequired,
  selectAcount: PropTypes.func.isRequired,
};

/**
 * Export
 */
export default signupForm;
