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
  zipcode,
  password,
  validate,
} from 'src/utils/form';
/**
 * Code
 */
const ProfileForm = (props) => {
  const {
    handleSubmit,
    acount,
    pristine,
    submitting,
    closeForm,
  } = props;
  return (
    <form className="connection-form animated fast fadeInRight" onSubmit={handleSubmit}>
      <FontAwesomeIcon icon="times" className="connection-form-close" onClick={closeForm} />
      <div className="connection-form-container">
        <Field
          type="password"
          component={renderField}
          name="password"
          label="Mot de passe:"
          placeholder="Entrez votre mot de passe"
          validate={[password]}
        />
        <Field
          type="password"
          component={renderField}
          name="confirmPassword"
          label="Confirmez le mot de passe:"
          placeholder="Confirmez le mot de passe"
          validate={[password]}
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
        />
        <Field
          type="number"
          component={renderField}
          name="zipcode"
          label="Code postal:"
          placeholder="Entrez le code postal"
          validate={[zipcode]}
        />
        {(acount === 'organizer' || acount === 'artist') && (
          <div>
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
          </div>
        )}
        <button type="submit" disabled={pristine || submitting}>
        Modifier
        </button>
      </div>
    </form>
  );
};

ProfileForm.propTypes = {
  handleSubmit: PropTypes.func.isRequired,
  acount: PropTypes.string.isRequired,
  pristine: PropTypes.bool.isRequired,
  submitting: PropTypes.bool.isRequired,
  closeForm: PropTypes.func.isRequired,
};
/**
 * Export
 */

export default reduxForm({
  form: 'profileForm',
  warn,
  validate,
  touchOnBlur: false,
  enableReinitialize: true,
})(ProfileForm);
