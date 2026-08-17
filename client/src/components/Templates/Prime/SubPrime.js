/**
 * Import
 */
import React from 'react';
import { Link } from 'react-router-dom';

import PrimeTile from './PrimeTile';
/**
 * Local import
 */
// Composants
// Styles et assets


/**
 * Code
 */
const SubPrime = ({ tiles }) => {
  const tilesTo = Object.entries(tiles.tiles).map(entry => entry[1]);
  return (
    <Link to="/place">
      <h1>{tiles.title}</h1>
      <h2>{tiles.subtitle}</h2>
      <div className="slider-container">

        {tilesTo.map(tile => (
          <PrimeTile
            key={tile.id}
            {...tile}
          />
        ))}

      </div>
    </Link>
  );
};

/**
 * Export
 */
export default SubPrime;
