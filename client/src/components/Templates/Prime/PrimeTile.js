/**
 * Import
 */
import React from 'react';

/**
 * Local import
 */
// Composants
// Styles et assets

/**
 * Code
 */
const PrimTile = ({ image, phrase, sentence }) => (
  <div className="slide-container">
    <div className="slide"
      style={{ backgroundImage: `url(${image})` }} ></div>
    <h3>
      {phrase}
    </h3>
    <h3 className="sentence">
      {sentence}
    </h3>
  </div>
);

/**
 * Export
 */
export default PrimTile;