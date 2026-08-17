/**
 * Import
 */
import React from 'react';
import { Field, reduxForm } from 'redux-form';
import PropTypes from 'prop-types';
/**
 * Local import
 */
import {
  renderField,
  warn,
  validate,
  asyncValidate,
  required,
  email,
} from 'src/utils/form';
/**
 * Code
 */
const WizardFormFirstPage = (props) => {
  const { handleSubmit, selectAcount } = props;
  return (
    <form onSubmit={handleSubmit} className="animated fadeIn">
      <h4>S'inscrire en tant que :</h4>
      <Field
        name="acount"
        component="select"
        onChange={(evt) => {
          selectAcount(evt.target.value);
        }}
      >
        <option value="spectator" key="spectator">Spectateur</option>
        <option value="artist" key="artist">Artiste</option>
        <option value="organizer" key="organizer">Organisateur</option>
      </Field>
      <Field
        type="email"
        component={renderField}
        name="email"
        label="Email:"
        placeholder="Entrez votre adresse email"
        validate={[required, email]}
      />
      <Field
        type="password"
        component={renderField}
        name="password"
        label="Mot de passe:"
        placeholder="Entrez votre mot de passe"
        validate={[required]}
      />
      <Field
        type="password"
        component={renderField}
        name="confirmPassword"
        label="Confirmez le mot de passe:"
        placeholder="Confirmez le mot de passe"
        validate={[required]}
      />
      <div>
        <button type="submit">
          Continuer
        </button>
      </div>
    </form>
  );
};

WizardFormFirstPage.propTypes = {
  selectAcount: PropTypes.func.isRequired,
  handleSubmit: PropTypes.func.isRequired,
};
/**
 * Export
 */

export default reduxForm({
  form: 'signupForm',
  validate,
  warn,
  asyncValidate,
  // enableReinitialize: true,
  asyncBlurFields: ['username', 'email'],
  destroyOnUnmount: false, // <------ preserve form data
  forceUnregisterOnUnmount: true, // <------ unregister fields on unmount
})(WizardFormFirstPage);
