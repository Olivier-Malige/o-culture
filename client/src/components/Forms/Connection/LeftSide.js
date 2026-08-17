/**
 * Import
 */
import React from 'react';
import PropTypes from 'prop-types';
/**
 * Local import
 */
// Composants

// Styles et assets

/**
 * Code
 */

const LeftSide = ({
  background,
  type,
}) => (
  <div
    className="connection-description animated fast fadeInLeft"
    style={{ backgroundImage: `url(${background})` }}
  >
    <div className="connection-description-header">
      <h2>O'culture</h2>
      {type === 'spectator' && (
      <h3>Spectateur</h3>
      )}
      {type === 'login' && (
      <h3>Connexion</h3>
      )}
      {type === 'artist' && (
      <h3>Artiste</h3>
      )}
      {type === 'organizer' && (
      <h3>Organisateur</h3>
      )}
    </div>
    {type === 'spectator' && (
      <div className="text-background">
        <p><span>O</span>'culture vous permet d'être informé de tous les évènements
          culturels près de chez vous
        </p>
        <p>Inscrivez-vous dès maintenant pour bénéficier d'un suivi personnalisé</p>
      </div>
    )}
    {type === 'artist' && (
      <div className="text-background">
        <p><span>O</span>'culture permet aux artistes d'être mis en relation avec d'autres
          professionnels, afin de favoriser la création de nouveaux évènements culturels.
        </p>
        <p>Si vous aussi vous souhaitez créer ou participer à un évènement,
          ou simplement connaître les artistes et organisateurs présents sur notre site
        </p>
        <p>Inscrivez-vous dès maintenant!</p>
      </div>
    )}
    {type === 'organizer' && (
      <div className="text-background">
        <p><span>O</span>'culture permet aux organisateurs d'accueillir ou de créer leurs
          propres évènements culturels.
        </p>
        <p>Si tel est votre cas, inscrivez-vous dès maintenant afin de prendre
          contact rapidemment avec tous les professionnels inscrits sur notre site.
        </p>
      </div>
    )}
    {type === 'login' && (
      <div className="text-background">
        <p>Saisissez vos identifiants pour entrer dans notre univers...</p>
      </div>
    )}
  </div>
);

LeftSide.propTypes = {
  // connect: PropTypes.string.isRequired,
  type: PropTypes.string.isRequired,
  background: PropTypes.string.isRequired,
};

/**
 * Export
 */
export default LeftSide;
