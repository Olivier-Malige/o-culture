/**
 * Import
 */
import React from 'react';
import PropTypes from 'prop-types';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { Link } from 'react-router-dom';

/**
 * Local import
 */
// Components
import Comments from 'src/containers/Comments/Comments';
import { formatDate, getHour } from 'src/utils/date';
import { assetUrl } from 'src/utils/asset';
// Styles and assets
import './event.sass';

/**
 * Code
 */

class Event extends React.Component {
  static propTypes = {
    currentEvent: PropTypes.object.isRequired,
    comments: PropTypes.array.isRequired,
    followEvent: PropTypes.func.isRequired,
    getCurrentEvent: PropTypes.func.isRequired,
    match: PropTypes.object.isRequired,
    userLogged: PropTypes.bool.isRequired,
    isFollowing: PropTypes.bool.isRequired,
    setLogin: PropTypes.func.isRequired,
  };

  state = {
    joining: false,
    joined: false,
    joinError: false,
  };

  handleChange = (evt) => {
    const { currentEvent, followEvent, userLogged, isFollowing, setLogin, match } = this.props;
    evt.preventDefault();
    evt.stopPropagation();
    if (!userLogged) {
      setLogin();
      return;
    }
    const eventId = currentEvent.id || Number(match.params.slug);
    if (!eventId || isFollowing || this.state.joining || this.state.joined) {
      return;
    }
    this.setState({ joining: true, joinError: false });
    Promise.resolve(followEvent(eventId))
      .then(() => {
        this.setState({ joining: false, joined: true });
      })
      .catch(() => {
        this.setState({ joining: false, joinError: true });
      });
  }

  componentDidMount = () => {
    const { getCurrentEvent, match } = this.props;
    getCurrentEvent(Number(match.params.slug));
  }

  componentDidUpdate(prevProps) {
    const { getCurrentEvent, match } = this.props;
    if (prevProps.match.params.slug !== match.params.slug) {
      this.setState({ joining: false, joined: false, joinError: false });
      getCurrentEvent(Number(match.params.slug));
    }
  }

  render() {
    const { currentEvent, comments, userLogged, isFollowing, setLogin } = this.props;
    const place = currentEvent.event_place || {};
    const creator = currentEvent.app_user_creator || {};
    const performer = (currentEvent._app_user_performer && currentEvent._app_user_performer[0]) || {};
    const eventType = currentEvent.event_type || {};

    // Set price to free if isn't defined
    const price = (currentEvent.price !== undefined) ? currentEvent.price : 'Gratuit';

    return (
      <div id="event">
        <div className="event">
          <div className="event-elements">
            <h1>{currentEvent.name}</h1>
            <p>Proposé par : <span><a href="">{creator.name}</a></span></p>
            <ul className="event-elements-list">
              <li><FontAwesomeIcon icon="calendar" /> {formatDate(currentEvent.planned_date)}</li>
              <li><FontAwesomeIcon icon="clock" /> {getHour(currentEvent.planned_date)}</li>
              <li><FontAwesomeIcon icon="euro-sign" /> {price} </li>
              <li><FontAwesomeIcon icon="font" /> {performer.name}</li>
              {place.id
                ? (
                  <Link to={`/place/${place.id}`}><FontAwesomeIcon icon="map-marker-alt" />
                    <span className="placeName">{place.name}</span>
                  </Link>
                ) : (
                  <li><FontAwesomeIcon icon="map-marker-alt" /> Lieu non renseigné</li>
                )
              }
              <li className="event-elements-list--place">
                <ul>
                  <li>{place.adress}</li>
                  <li>{place.city}</li>
                  <li>{place.zipcode}</li>
                  <li>{place.email}</li>
                </ul>
              </li>
              <li><FontAwesomeIcon icon="neuter" /> {eventType.name}</li>
            </ul>
          </div>
          <div className="event-images animated fadeInLeft">
            <img src={assetUrl(currentEvent.image)} alt="" />
          </div>
          <div className="event-abstract">
            <p>{currentEvent.description}</p>
          </div>
          <div className="event-comments">
            <div className="event-title">Commentaires</div>
            <Comments pageId={currentEvent.id} comments={comments} pageType="Event" />
          </div>
          <div className="event-sidebar">
            <div className="event-sidebar--map">Google Maps</div>
            <div className="event-sidebar--follow">
              {userLogged
                ? (
                  <button
                    type="button"
                    className="event-follow-button"
                    onClick={this.handleChange}
                    disabled={this.state.joining || this.state.joined || isFollowing}
                  >
                    {this.state.joining && 'Inscription...'}
                    {!this.state.joining && (this.state.joined || isFollowing) && 'Inscrit'}
                    {!this.state.joining && !this.state.joined && !isFollowing && 'S\'inscrire à l\'événement'}
                  </button>
                ) : (
                  <button type="button" className="event-follow-button" onClick={setLogin}>
                    Connectez-vous pour vous inscrire
                  </button>
                )
              }
              {this.state.joinError && (
                <p className="event-follow-error">Inscription impossible, réessayez.</p>
              )}
            </div>
          </div>
        </div>
      </div>
    );
  }
}


/**
 * Export
 */
export default Event;
