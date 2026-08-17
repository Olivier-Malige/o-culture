/**
 * Import
 */
// uuidv4 is used for generate a unique key
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
  required,
  number,
} from 'src/utils/form';
import { eventsPictures } from 'src/data/imagesType';
/**
 * Code
 */
class EventForm extends React.Component {
  componentDidMount() {
    const { setCurrentPictureEvent } = this.props;
    setCurrentPictureEvent('EventDefault.jpg');
  }

  render() {
    const {
      handleSubmit,
      eventType,
      userPlaces,
      closeForm,
      setCurrentPictureEvent,
    } = this.props;
    return (
      <form className="connection-form animated fast fadeInRight" onSubmit={handleSubmit}>
        <FontAwesomeIcon icon="times" className="connection-form-close" onClick={closeForm} />
        <div className="connection-form-container">

          <Field
            type="text"
            component={renderField}
            name="name"
            label="nom :"
            placeholder="Entrez le nom de l'événement"
            validate={required}
          />
          <Field
            type="datetime-local"
            component={renderField}
            name="planned_date"
            label="date :"
            placeholder="Entrez la date de l'événement"
            validate={required}
          />
          <Field
            type="number"
            component={renderField}
            name="nb_spectator"
            label="nombre de places :"
            placeholder="Entrez le nombre de places disponible"
            validate={number}
          />
          <Field
            type="number"
            component={renderField}
            name="price"
            label="Prix :"
            placeholder="Entrez le prix d'entrée"
            validate={number}
          />
          <Field
            type="text"
            component={renderField}
            name="description"
            label="description :"
            placeholder="Entrez une description"
          />
          <span className="form-label">Image :</span>
          <Field
            onChange={(evt) => {
              setCurrentPictureEvent(evt.target.value);
            }}
            name="image"
            component="select"
          >
            {eventsPictures.map(elem => (
              <option value={elem.picture} key={uuidv4()}>{elem.name}</option>
            ))}
          </Field>
          <span className="form-label">Lieu :</span>
          <Field
            name="place_id"
            component="select"
          >
            {userPlaces.map(elem => (
              <option value={elem.name} key={uuidv4()}>{elem.name}</option>
            ))}
          </Field>
          <span className="form-label">Type :</span>
          <Field
            name="event_type_id"
            component="select"
          >
            {eventType.map(elem => (
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

EventForm.propTypes = {
  handleSubmit: PropTypes.func.isRequired,
  setCurrentPictureEvent: PropTypes.func.isRequired,
  closeForm: PropTypes.func.isRequired,
  eventType: PropTypes.array.isRequired,
  userPlaces: PropTypes.array.isRequired,
};
/**
 * Export
 */

export default reduxForm({
  form: 'eventForm',
  // enableReinitialize: true,
})(EventForm);
