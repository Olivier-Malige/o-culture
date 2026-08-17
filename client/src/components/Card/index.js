/**
 * Import
 */
import React from 'react';
import PropTypes from 'prop-types';
import { Link } from 'react-router-dom';
/**
 * Local import
 */
import { formatDate, getHour } from 'src/utils/date';
import { assetUrl } from 'src/utils/asset';
// Components

// Styles and assets
import './card.sass';

/**
 * Code
 */
const Card = ({
  image,
  id,
  name,
  date,
  place,
}) => (
  <Link to={`/event/${id}`}>

    <div
      className="card"
      style={{ backgroundImage: `url(${assetUrl(image)})` }}
    >
      <div className="card-title">
        {name}
      </div>
      <div className="card-detail">
        {date && (
          <div>
            {`Le ${formatDate(date)} à ${getHour(date)}`}
          </div>
        )}
        <div>
          {place && place.city}
        </div>
        <div>
          {place && place.name}
        </div>
      </div>
    </div>
  </Link>
);

Card.propTypes = {
  image: PropTypes.string,
  id: PropTypes.number,
  name: PropTypes.string.isRequired,
  date: PropTypes.string,
  place: PropTypes.object,
};
Card.defaultProps = {
  id: undefined,
  image: '',
  date: '',
  place: {
    city: '',
    name: '',
  },
};

/**
 * Export
 */
export default Card;
