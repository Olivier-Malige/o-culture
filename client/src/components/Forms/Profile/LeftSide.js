/**
 * Import
 */
import React from 'react';
import PropTypes from 'prop-types';
import { assetUrl } from 'src/utils/asset';
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
    style={{ backgroundImage: `url(${assetUrl(background)})` }}
  >
    <div className="connection-description-header">
      <h2>O'culture</h2>
      {type === 'updateProfile' && (
      <h3>Modifier votre profil</h3>
      )}
      {type === 'createEvent' && (
      <h3>Créer un évènement</h3>
      )}
      {type === 'createPlace' && (
      <h3>Enregistrer un lieu</h3>
      )}
      {type === 'updateEvent' && (
      <h3>Modifier un évènement</h3>
      )}
      {type === 'updatePlace' && (
      <h3>Modifier un lieu</h3>
      )}
    </div>
    {type === 'updateProfile' && (
      <div className="text-background">
        <p><span>O</span>'culture vous permet d'être informé de tous les évènements
          culturels près de chez vous
        </p>
        <p>Vous pouvez modifier les informations de votre profil en soumettant ce formulaire</p>
      </div>
    )}
    {type === 'createEvent' && (
      <div className="text-background">
        <p><span> O </span>'culture permet de mettre en relation Artistes et
        Organisateurs, afin de favoriser la création de nouveaux évènements
        culturels pour les partager avec la communauté.
        </p>
      </div>
    )}
    {type === 'createPlace' && (
      <div className="text-background">
        <p><span> O </span>'culture permet de mettre en relation Artistes et
        Organisateurs, afin d'enregistrer de nouveaux lieux de spectables.
        </p>
      </div>
    )}
    {type === 'updateEvent' && (
      <div className="text-background">
        <p>Vous pouvez modifier les informations de l'évènement en soumettant ce formulaire</p>
      </div>
    )}
    {type === 'updatePlace' && (
      <div className="text-background">
        <p> Vous pouvez modifier les informations du lieu en soumettant ce formulaire </p>
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
