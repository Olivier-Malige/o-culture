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
} from 'src/utils/form';
/**
 * Code
 */
const WizardFormThirdPage = (props) => {
  const {
    handleSubmit,
    prevPage,
  } = props;
  return (
    <form onSubmit={handleSubmit} className="animated fadeIn">
      <h4>Nous avons besoin de quelques informations supplémentaires (optionnel) :</h4>
      <Field
        type="text"
        component={renderField}
        name="website"
        label="Site web:"
        placeholder="Entrez l'adresse de votre site web"
      />
      <Field
        type="text"
        component={renderField}
        name="facebook"
        label="Compte facebook:"
        placeholder="Entrez votre compte facebook"
      />
      <Field
        type="text"
        component={renderField}
        name="twitter"
        label="Compte twitter:"
        placeholder="Entrez votre compte twitter"
      />
      <Field
        type="text"
        component={renderField}
        name="description"
        label="Description:"
        placeholder="Entrez une description"
      />
      <div className="connection-form-buttons">
        <FontAwesomeIcon className="connection-form-buttons-prev" icon="arrow-alt-circle-left" size="2x" onClick={prevPage} />
        <button type="submit" onClick={handleSubmit}>
          Inscription
        </button>
      </div>
    </form>
  );
};

WizardFormThirdPage.propTypes = {
  handleSubmit: PropTypes.func.isRequired,
  prevPage: PropTypes.func.isRequired,
};
/**
 * Export
 */

export default reduxForm({
  form: 'signupForm',
  validate,
  warn,
  destroyOnUnmount: false, // <------ preserve form data
  forceUnregisterOnUnmount: true, // <------ unregister fields on unmount
})(WizardFormThirdPage);
