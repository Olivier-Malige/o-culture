/**
 * Import
 */
import { v4 as uuidv4 } from 'uuid';
import React from 'react';
import PropTypes from 'prop-types';
import { Link } from 'react-router-dom';
/**
 * Local import
 */
import Welcome from 'src/components/Templates/One';
import Card from 'src/components/Card';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
// Components
import ProfileForm from 'src/containers/Forms/Profile/ProfileForm';
import PlaceForm from 'src/containers/Forms/Profile/PlaceForm';
import UpdatePlaceForm from 'src/containers/Forms/Profile/UpdatePlaceForm';
import UpdateEventForm from 'src/containers/Forms/Profile/UpdateEventForm';
import EventForm from 'src/containers/Forms/Profile/EventForm';
import LeftSide from 'src/components/Forms/Profile/LeftSide';
import { assetUrl } from 'src/utils/asset';

// Styles and assets
import './profile.sass';

/**
 * Code
 */
class Profile extends React.Component {
  componentWillMount() {
    const { getUserProfile, getEventType } = this.props;
    getUserProfile();
    getEventType();
  }

  // prepare objet to intialize correctly UpdateEventForm
  prepareCurrentUpdateEvent(elem) {
    const { setCurrentUpdateEvent, setCurrentPictureEvent } = this.props;
    // store picture for preview
    const currentPictureUpdateEvent = elem.image;
    const preparedElem = {
      ...elem,
      event_type_id: elem.event_type.name,
      planned_date: elem.planned_date.replace(' ', 'T'),
    };
    setCurrentUpdateEvent(preparedElem, currentPictureUpdateEvent);
    setCurrentPictureEvent(currentPictureUpdateEvent);
  }

  // prepare objet to intialize correctly UpdatePlaceForm
  prepareCurrentUpdatePlace(elem) {
    const currentPictureUpdatePlace = elem.image;
    // store picture for preview
    const { setCurrentUpdatePlace, setCurrentPicturePlace } = this.props;
    const preparedElem = {
      ...elem,
      // place_id: elem._place_type.name,
    };
    setCurrentUpdatePlace(preparedElem);
    setCurrentPicturePlace(currentPictureUpdatePlace);
  }

  render() {
    const {
      acount,
      userEvents,
      userPlaces,
      userFollowEvents,
      deleteEvent,
      deletePlace,
      isCreatePlace,
      isCreateEvent,
      isUpdateEvent,
      isUpdatePlace,
      isUpdateProfile,
      submitUpdateProfile,
      submitUpdateEvent,
      submitUpdatePlace,
      submitCreateEvent,
      submitCreatePlace,
      showUpdateEvent,
      showUpdatePlace,
      showUpdateProfile,
      showCreateEvent,
      showCreatePlace,
      closeForm,
      userName,
      currentPicturePlace,
      currentPictureEvent,
    } = this.props;
    // Set appropriate background for LeftSide
    let background;
    let slogan;
    if (acount === 'spectator') {
      background = '/src/assets/1.jpg';
      slogan = 'Participez à des évenements...';
    }
    else if (acount === 'artist') {
      background = '/src/assets/artist.jpg';
      slogan = 'Créez vos propres événements...';
    }
    else if (acount === 'organizer') {
      background = '/src/assets/organizer.jpg';
      slogan = 'Organisez et créez des évenements...';
    }
    return (
      <div id="profile">
        <Welcome
          image={background}
          title={userName}
          slogan={slogan}
          titleClassName="animated bounce"
          sloganClassName="animated bounceInLeft"
        />
        <FontAwesomeIcon
          className="profile-user animated bounceIn slower"
          size="5x"
          icon="user-cog"
          onClick={showUpdateProfile}
        />
        {isCreateEvent && (
          <div className="connection-container">
            <LeftSide
              background={currentPictureEvent}
              type="createEvent"
            />
            <EventForm
              onSubmit={submitCreateEvent}
              closeForm={closeForm}
            />
          </div>
        )}
        {isCreatePlace && (
          <div className="connection-container">
            <LeftSide
              background={currentPicturePlace}
              type="createPlace"
            />
            <PlaceForm
              onSubmit={submitCreatePlace}
              closeForm={closeForm}
            />
          </div>
        )}
        {isUpdateProfile && (
          <div className="connection-container">
            <LeftSide
              background="profile.jpg"
              type="updateProfile"
            />
            <ProfileForm
              onSubmit={submitUpdateProfile}
              closeForm={closeForm}
            />
          </div>
        )}
        {isUpdateEvent && (
          <div className="connection-container">
            <LeftSide
              background={currentPictureEvent}
              type="updateEvent"
            />
            <UpdateEventForm
              onSubmit={submitUpdateEvent}
              closeForm={closeForm}
            />
          </div>
        )}
        {isUpdatePlace && (
          <div className="connection-container">
            <LeftSide
              background={currentPicturePlace}
              type="updatePlace"
            />
            <UpdatePlaceForm
              onSubmit={submitUpdatePlace}
              closeForm={closeForm}
            />
          </div>
        )}
        {(acount === 'artist' || acount === 'organizer') && (
          <div>
            <h4>Mes lieux :</h4>
            <section className="cards">
              { userPlaces.map(elem => (
                <div key={uuidv4()}>
                  <div
                    className="card"
                    style={{ backgroundImage: `url(${assetUrl(elem.image)})` }}
                  >
                    <div className="tools">
                      <FontAwesomeIcon
                        className="tools-tool"
                        size="lg"
                        icon="edit"
                        onClick={() => {
                          this.prepareCurrentUpdatePlace(elem);
                          showUpdatePlace();
                        }}
                      />
                      <FontAwesomeIcon
                        className="tools-tool"
                        size="lg"
                        icon="times"
                        onClick={() => {
                          deletePlace(elem.id);
                        }}
                      />
                    </div>
                    <Link to={`/place/${elem.id}`}>
                      <div className="card-title">
                        {elem.name}
                      </div>
                    </Link>
                    <div className="card-detail">
                      {elem.city}
                    </div>
                  </div>
                </div>
              ))}
              <div className="more animated pulse infinite">
                <FontAwesomeIcon
                  className="pluscircle"
                  size="6x"
                  icon="plus-circle"
                  onClick={showCreatePlace}
                />
              </div>
            </section>
            <section className="odd">
              <h4 className="odd">Mes événements :</h4>
              <div className="cards">
                { userEvents.map(elem => (
                  <div key={uuidv4()}>
                    <div
                      className="card"
                      style={{ backgroundImage: `url(${assetUrl(elem.image)})` }}
                    >
                      <div className="tools">
                        <FontAwesomeIcon
                          className="tools-tool"
                          size="lg"
                          icon="edit"
                          onClick={() => {
                            this.prepareCurrentUpdateEvent(elem);
                            showUpdateEvent();
                          }}
                        />
                        <FontAwesomeIcon
                          className="tools-tool"
                          size="lg"
                          icon="times"
                          onClick={() => {
                            deleteEvent(elem.id);
                          }}
                        />
                      </div>
                      <Link to={`/event/${elem.id}`}>
                        <div className="card-title">
                          {elem.name}
                        </div>
                      </Link>
                      <div className="card-detail">
                        <div>
                          {elem.event_place.name}
                        </div>
                        <div>
                          {elem.planned_date}
                        </div>
                      </div>
                    </div>
                  </div>
                ))}
                {(userPlaces.length > 0 && (
                  <div className="more animated pulse infinite">
                    <FontAwesomeIcon
                      className="pluscircle"
                      size="6x"
                      icon="plus-circle"
                      onClick={showCreateEvent}
                    />
                  </div>
                ))}
                {(userPlaces.length === 0 && (
                  <p className="info">Enregistrer un lieu pour créer des évènements</p>
                ))}
              </div>
            </section>
          </div>
        )}
        <h4>Mes inscriptions :</h4>
        <section className="cards">
          {userFollowEvents.length === 0 && (
            <p className="info">Aucune inscription pour le moment</p>
          )}
          {userFollowEvents.map(elem => (
            <Card
              key={elem.id || uuidv4()}
              id={elem.id}
              name={elem.name}
              image={elem.image}
              date={elem.planned_date}
              place={elem.event_place || undefined}
            />
          ))}
        </section>
      </div>
    );
  }
}
Profile.defaultProps = {
  userEvents: [],
  userPlaces: [],
  userFollowEvents: [],
  currentPicturePlace: 'placeDefault.jpg',
  currentPictureEvent: 'EventDefault.jpg',
};

Profile.propTypes = {
  getUserProfile: PropTypes.func.isRequired,
  submitUpdateProfile: PropTypes.func.isRequired,
  acount: PropTypes.string.isRequired,
  userName: PropTypes.string.isRequired,
  userEvents: PropTypes.array,
  userPlaces: PropTypes.array,
  userFollowEvents: PropTypes.array,
  deleteEvent: PropTypes.func.isRequired,
  deletePlace: PropTypes.func.isRequired,
  getEventType: PropTypes.func.isRequired,
  submitUpdateEvent: PropTypes.func.isRequired,
  submitUpdatePlace: PropTypes.func.isRequired,
  submitCreateEvent: PropTypes.func.isRequired,
  submitCreatePlace: PropTypes.func.isRequired,
  isUpdateEvent: PropTypes.bool.isRequired,
  isUpdateProfile: PropTypes.bool.isRequired,
  isUpdatePlace: PropTypes.bool.isRequired,
  isCreateEvent: PropTypes.bool.isRequired,
  isCreatePlace: PropTypes.bool.isRequired,
  showUpdateEvent: PropTypes.func.isRequired,
  showUpdatePlace: PropTypes.func.isRequired,
  showCreatePlace: PropTypes.func.isRequired,
  showCreateEvent: PropTypes.func.isRequired,
  showUpdateProfile: PropTypes.func.isRequired,
  setCurrentUpdatePlace: PropTypes.func.isRequired,
  setCurrentUpdateEvent: PropTypes.func.isRequired,
  setCurrentPictureEvent: PropTypes.func.isRequired,
  setCurrentPicturePlace: PropTypes.func.isRequired,
  closeForm: PropTypes.func.isRequired,
  currentPictureEvent: PropTypes.string,
  currentPicturePlace: PropTypes.string,
};
/**
 * Export
 */
export default Profile;
