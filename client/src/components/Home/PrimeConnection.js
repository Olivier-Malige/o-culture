/**
 * Import
 */
import React from 'react';
import PropTypes from 'prop-types';

/**
 * Local import
 */
// Composants
// Styles
import 'src/components/Templates/Prime/prime.sass';

/**
 * Code
 */
const PrimeConnection = ({
  spectatorSignup,
  artistSignup,
  organizerSignup,
}) => (
  <section className="section slider">
    <h2>S'inscrire en tant que</h2>
    <div className="slider-container">
      <div className="slide-container" onClick={spectatorSignup}>
        <div
          className="slide--connect slide-role"
          style={{ backgroundImage: 'url(/src/assets/1.jpg)' }}
        >
          <h3>Spectateur</h3>
        </div>
      </div>
      <div className="slide-container" onClick={artistSignup}>
        <div className="slide--connect slide-role" style={{ backgroundImage: 'url(/src/assets/artist.jpg)' }}>
          <h3>Artiste</h3>
        </div>
      </div>
      <div className="slide-container" onClick={organizerSignup}>
        <div className="slide--connect slide-role" style={{ backgroundImage: 'url(/src/assets/organizer.jpg)' }}>
          <h3>Organisateur</h3>
        </div>
      </div>
    </div>
  </section>
);

PrimeConnection.propTypes = {
  spectatorSignup: PropTypes.func.isRequired,
  artistSignup: PropTypes.func.isRequired,
  organizerSignup: PropTypes.func.isRequired,
};
export default PrimeConnection;
