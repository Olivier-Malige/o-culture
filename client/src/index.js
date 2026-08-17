/**
 * NPM import
 */
import 'babel-polyfill';
import React from 'react';
import { render } from 'react-dom';
import { Provider } from 'react-redux';
import { library } from '@fortawesome/fontawesome-svg-core';
import { BrowserRouter as Router } from 'react-router-dom';
import ScrollToTop from 'src/components/ScrollToTop';
/**
 * Local import
 */

import App from 'src/containers/App';
// store
import store from 'src/store';

// Fontawesome local
import {
  faPlusCircle,
  faUserCog,
  faMapMarkerAlt,
  faFont,
  faClock,
  faCalendar,
  faNeuter,
  faTimes,
  faExclamationTriangle,
  faExclamationCircle,
  faSignInAlt,
  faSignOutAlt,
  faUserPlus,
  faArrowAltCircleLeft,
  faEdit,
  faEnvelope,
  faQuestionCircle,
  faBalanceScale,
  faEuroSign,
} from '@fortawesome/free-solid-svg-icons';

// Add font awesome to projet
library.add(
  faBalanceScale,
  faEnvelope,
  faPlusCircle,
  faUserCog,
  faUserPlus,
  faSignInAlt,
  faMapMarkerAlt,
  faFont,
  faClock,
  faCalendar,
  faNeuter,
  faTimes,
  faExclamationTriangle,
  faExclamationCircle,
  faSignOutAlt,
  faArrowAltCircleLeft,
  faEdit,
  faQuestionCircle,
  faEuroSign,
);

/**
 * Code
 */
const rootComponent = (
  <Provider store={store}>
    <Router>
      <ScrollToTop>
        <App />
      </ScrollToTop>
    </Router>
  </Provider>
);

render(rootComponent, document.getElementById('root'));
