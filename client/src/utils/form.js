/**
 * Import
 */
import PropTypes from 'prop-types';
import React from 'react';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import Server from 'src/utils/server';
/**
 * reduxForm utility function allowing  to control and warning error for forms
 */

// display errors and warning
export const renderField = ({
  input,
  label,
  placeholder,
  type,
  meta: { touched, error, warning },
}) => (
  <div>
    <span className="form-label">{label}</span>
    {touched
      && ((error
        && (
        <span className="form-error">
          {error} <FontAwesomeIcon icon="exclamation-triangle" />
        </span>
        ))
      || (warning
        && (
        <span className="form-warning">
          {warning} <FontAwesomeIcon icon="exclamation-circle" />
        </span>
        )))}
    <input {...input} placeholder={placeholder} type={type} />
  </div>
);

renderField.propTypes = {
  input: PropTypes.object.isRequired,
  label: PropTypes.string.isRequired,
  type: PropTypes.string.isRequired,
  meta: PropTypes.object.isRequired,
  placeholder: PropTypes.string.isRequired,
};

// setup warning to validate forms
export const warn = (values) => {
  const warnings = {};
  if (values.username !== undefined) {
    if (values.username.length < 2) {
      warnings.username = ' doit faire plus 2 caractères';
    }
    if (values.username.length >= 20) {
      warnings.username = ' doit être inférieur à 20 caractères';
    }
  }
  if (values.password !== undefined && (values.password.length < 8)) {
    warnings.password = ' doit être supérieur 8 caractères';
  }
  return warnings;
};

// Field validate Zipcode
export const zipcode = value => (value && !/^[0-9]{5}$/i.test(value)
  ? ' est invalide'
  : undefined);
// Field validate Password
export const password = value => (value < 8
  ? ' doit être supérieur 8 caractères'
  : undefined);
// Field validate Required
export const required = value => (value || typeof value === 'number' ? undefined : ' est requis');
// Field validate number
export const number = value => (!value || (/^\d+$/i.test(value)) ? undefined : ' est invalide');
// Field validate Email
export const email = value => (value && !/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i.test(value)
  ? ' est invalide'
  : undefined);

// setup errors to validate forms for login and signup
export const validate = (values) => {
  const errors = {};
  if (values.password !== undefined && (values.password.length < 8)) {
    errors.password = ' doit être supérieur 8 caractères';
  }
  if ((values.password != null && values.confirmPassword != null)
    && (values.password !== values.confirmPassword)) {
    errors.password = ' les mots de passe sont différents';
  }

  return errors;
};

const server = new Server();
export const asyncValidate = (values, dispatch, props, currentFieldName) => new Promise((resolve, reject) => {
  if (currentFieldName === 'username') {
    server.api.post('/api/searchByUsername', values).then((response) => {
      if (response.data.status === true) {
        reject({ username: ' ce pseudo est déjà utilisé' });
      }
      else {
        resolve();
      }
    });
  }
  else if (currentFieldName === 'email') {
    server.api.post('/api/searchByEmail', values).then((response) => {
      if (response.data.status === true) {
        reject({ email: ' cet email est déjà utilisé' });
      }
      else {
        resolve();
      }
    });
  }
  else {
    resolve();
  }
});
