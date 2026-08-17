/**
 * Import
 */
// uuidv4 is used for generate unique key
import uuidv4 from 'uuid/v4';

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
  email,
  zipcode,
} from 'src/utils/form';
import { placesPictures } from 'src/data/imagesType';
/**
 * Code
 */
class PlaceForm extends React.Component {
  componentDidMount() {
    const { getPlaceType, setCurrentPicturePlace } = this.props;
    getPlaceType();
    setCurrentPicturePlace('placeDefault.jpg');
  }

  render() {
    const {
      handleSubmit,
      placeType,
      closeForm,
      setCurrentPicturePlace,
    } = this.props;
    return (
      <form className="connection-form animated fast fadeInRight" onSubmit={handleSubmit}>
        <FontAwesomeIcon icon="times" className="connection-form-close" onClick={closeForm} />
        <div className="connection-form-container">
          <Field
            type="text"
            component={renderField}
            name="name"
            label="Nom :"
            placeholder="Entrez un nom"
            validate={[required]}
          />
          <Field
            type="text"
            component={renderField}
            name="adress"
            label="Adresse :"
            placeholder="Entrez l'adresse"
            validate={[required]}
          />
          <Field
            type="text"
            component={renderField}
            name="city"
            label="Ville :"
            placeholder="Entrez la ville"
            validate={[required]}
          />
          <Field
            type="number"
            component={renderField}
            name="zipcode"
            label="Code postal :"
            placeholder="Entrez le code postal"
            validate={[required, zipcode]}
          />
          <Field
            type="text"
            component={renderField}
            name="description"
            label="description :"
            placeholder="Entrez une description"
          />
          <Field
            type="email"
            component={renderField}
            name="email"
            label="email :"
            placeholder="Entrez un email"
            validate={[email]}
          />
          <Field
            type="text"
            component={renderField}
            name="website"
            label="Site web :"
            placeholder="Entrez un site web"
          />
          <Field
            type="text"
            component={renderField}
            name="facebook"
            label="Facebook :"
            placeholder="Entrez un facebook"
          />
          <span className="form-label">Image :</span>
          <Field
            onChange={(evt) => {
              setCurrentPicturePlace(evt.target.value);
            }}
            name="image"
            component="select"
          >
            {placesPictures.map(elem => (
              <option value={elem.picture} key={uuidv4()}>{elem.name}</option>
            ))}

          </Field>
          <span className="form-label">Type :</span>
          <Field
            name="place_type"
            component="select"
          >
            {placeType.map(elem => (
              <option value={elem.name} key={uuidv4()}>{elem.name}</option>
            ))}
          </Field>
          <button type="submit">
            Créer
          </button>
        </div>
      </form>
    );
  }
}

PlaceForm.propTypes = {
  handleSubmit: PropTypes.func.isRequired,
  placeType: PropTypes.array.isRequired,
  getPlaceType: PropTypes.func.isRequired,
  setCurrentPicturePlace: PropTypes.func.isRequired,
  closeForm: PropTypes.func.isRequired,
};
/**
 * Export
 */

export default reduxForm({
  form: 'placeForm',
  warn,
  validate,
  enableReinitialize: true,
})(PlaceForm);
