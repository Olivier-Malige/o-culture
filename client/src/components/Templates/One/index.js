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
import './one.sass';

/**
 * Code
 */
const One = ({ image, title, slogan, titleClassName, sloganClassName }) => (
  <section className="one animated fadeIn faster" style={{ backgroundImage: `url(${image})` }}>
    <h1 className={titleClassName}>{title}</h1>
    <h2 className={sloganClassName}>{slogan}</h2>
  </section>
);

One.propTypes = {
  // image: PropTypes.string.isRequired,
  // title: PropTypes.string.isRequired,
  // slogan: PropTypes.string.isRequired,
};
/**
 * Export
 */
export default One;
