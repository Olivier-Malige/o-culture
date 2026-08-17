/**
 * Import
 */
import React from 'react';
import { Field, reduxForm } from 'redux-form';
import PropTypes from 'prop-types';
/**
 * Local import
 */
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import {
  renderField,
  warn,
  validate,
  required,
  zipcode,
} from 'src/utils/form';
/**
 * Code
 */
const WizardFormSecondPage = (props) => {
  const {
    handleSubmit,
    acount,
    prevPage,
  } = props;
  return (
    <form onSubmit={handleSubmit} className="animated fadeIn">
      <h4>Un peu plus sur vous :</h4>
      <Field
        type="text"
        component={renderField}
        name="username"
        label="Pseudo:"
        placeholder="Entrez un pseudo"
        validate={[required]}
      />
      <Field
        type="text"
        component={renderField}
        name="name"
        label="Nom:"
        placeholder="Entrez votre nom"
      />
      <Field
        type="text"
        component={renderField}
        name="city"
        label="Ville:"
        placeholder="Entrez votre ville"
        validate={[required]}
      />
      <Field
        type="number"
        component={renderField}
        name="zipcode"
        label="Code postal:"
        placeholder="Entrez le code postal"
        validate={[required, zipcode]}
      />

      <div className="connection-form-buttons">
        <FontAwesomeIcon className="connection-form-buttons-prev" icon="arrow-alt-circle-left" size="2x" onClick={prevPage} />
        {(acount === 'artist' || acount === 'organizer') && (
          <button type="submit">
            Continuer
          </button>
        )}
        {acount === 'spectator' && (
          <button type="submit">
            Inscription
          </button>
        )}
      </div>
    </form>
  );
};

WizardFormSecondPage.propTypes = {
  handleSubmit: PropTypes.func.isRequired,
  acount: PropTypes.string.isRequired,
  prevPage: PropTypes.func.isRequired,
};
/**
 * Export
 */

export default reduxForm({
  form: 'signupForm',
  validate,
  warn,
  destroyOnUnmount: false, // preserve form data
  forceUnregisterOnUnmount: true, // <------ unregister fields on unmount
})(WizardFormSecondPage);
