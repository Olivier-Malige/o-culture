/**
 * Import
 */
import React from 'react';
/**
 * Local import
 */
// Components
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';


// Styles and assets
import './footer.sass';

/**
 * Code
 */
const Footer = () => (
  <footer>
    <div className="footer-header" />
    <div className="footer-content">
      <div className="footer-title">
        <h2>O'Culture</h2>
        <p className="footer-copy"> &copy;2018</p>
      </div>
      <div className="footer-links">
        {/* <FontAwesomeIcon icon="facebook-square" size="lg" />
        <FontAwesomeIcon icon="twitter-square" size="lg" /> */}
        <a href="#">
          <FontAwesomeIcon className="footer-links-icon" icon="envelope" size="2x" />
          Contact
        </a>
        <a href="#">
          <FontAwesomeIcon className="footer-links-icon" icon="balance-scale" size="2x" />
          Mentions légals
        </a>
        <a href="#">
          <FontAwesomeIcon className="footer-links-icon" icon="question-circle" size="2x" />
          F.A.Q
        </a>
      </div>
    </div>
  </footer>
);


/**
 * Export
 */
export default Footer;
