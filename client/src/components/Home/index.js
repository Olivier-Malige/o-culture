/**
 * Import
 */
import React from 'react';
import PropTypes from 'prop-types';
import uuidv4 from 'uuid/v4';
/**
 * Local import
 */
import Card from 'src/components/Card';
// Components
import Welcome from 'src/components/Templates/One';
import PrimeConnection from 'src/containers/Home/PrimeConnection';
// Styles and assets
import './home.sass';

/**
 * Code
 */
const Home = ({
  events,
  loggedUser,
  userName,
}) => (
  <div id="home">
    <Welcome
      image="/src/assets/one.jpg"
      title="O'culture"
      slogan="Vivez, Partagez, Créez... "
      titleClassName="animated tada"
      sloganClassName="animated pulse infinite slow"
    />
    {loggedUser ? (
      <h3 className="Welcome">Bienvenue {userName}</h3>
    ) : (
      <PrimeConnection />
    )}
    <div className="content">
      <div className="tiles-title">Événements à venir</div>
      <section className="cards">
        {events.map(elem => (
          <Card
            key={uuidv4()}
            date={elem.planned_date}
            place={elem.event_place}
            {...elem}
          />
        ))}
      </section>
    </div>
  </div>
);
Home.propTypes = {
  loggedUser: PropTypes.bool.isRequired,
  userName: PropTypes.string.isRequired,
  events: PropTypes.array.isRequired,
};


/**
 * Export
 */
export default Home;
