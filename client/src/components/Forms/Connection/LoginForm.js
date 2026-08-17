/**
 * Import
 */
import React from 'react';
import PropTypes from 'prop-types';
import { Field, reduxForm } from 'redux-form';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
/**
 * Local import
 */
import {
  renderField,
  warn,
  validate,
  required,
  email,
  password,
} from 'src/utils/form';
// Composants
// Styles et assets
import './connection.sass';

/**
 * Code
 */
const LoginForm = ({
  onClose,
  setSignup,
  handleSubmit,
  submitting,
  loginError,
}) => (
  <div className="connection-form animated fast fadeInRight">
    <FontAwesomeIcon icon="times" className="connection-form-close" onClick={onClose} />
    <form onSubmit={handleSubmit}>
      <div className="connection-form-container">
        <h4>Se connecter à O'culture</h4>
        <div className="connection-form-container-field">
          {loginError && (
            <span className="form-error">
              {loginError}
              <FontAwesomeIcon icon="exclamation-triangle" />
            </span>
          )}
          <Field
            type="text"
            name="email"
            component={renderField}
            label="Email:"
            placeholder="Entrez votre email de connexion"
            validate={[required, email]}
          />
          <Field
            type="password"
            name="password"
            component={renderField}
            label="Mot de passe:"
            placeholder="Entrez votre mot de passe"
            validate={[required, password]}
          />
          <button type="submit" disabled={submitting}>Connexion</button>
          <div onClick={setSignup} className="connection-form-signin">
            <p>Vous n'avez pas de compte ?<span> Inscription</span></p>
          </div>
        </div>
      </div>
    </form>
  </div>
);

LoginForm.propTypes = {
  onClose: PropTypes.func.isRequired,
  setSignup: PropTypes.func.isRequired,
  handleSubmit: PropTypes.func.isRequired,
  submitting: PropTypes.bool.isRequired,
  loginError: PropTypes.string.isRequired,
};
/**
 * Export
 */
export default reduxForm({
  form: 'loginForm',
  validate,
  warn,
})(LoginForm);
