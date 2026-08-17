/**
 * Import
 */
import React from 'react';
import { Route, Switch } from 'react-router-dom';
import PropTypes from 'prop-types';

/**
 * Local import
 */

// Composants
import HeadBar from 'src/containers/HeadBar';
import Footer from 'src/components/Footer';
import Home from 'src/containers/Home/Home';
import Error from 'src/components/Error';
import Profile from 'src/containers/Profile';
import Event from 'src/containers/Event/Event';
import Place from 'src/containers/Place/Place';
import SearchResult from 'src/components/SearchResult';
import { parseJwt } from 'src/utils/jwt';
// Styles and assets
import './app.sass';

/**
 * Code
 */
class App extends React.Component {
  static propTypes = {
    getEventsList: PropTypes.func.isRequired,
    getPlacesList: PropTypes.func.isRequired,
    loginUser: PropTypes.func.isRequired,
    getUserProfile: PropTypes.func.isRequired,
  };

  componentDidMount() {
    const { getEventsList, getPlacesList, loginUser, getUserProfile } = this.props;
    // Check in localStorage if the user have a valid JWT token and then connect
    if (parseJwt()) {
      // Login it
      loginUser(parseJwt());
      getUserProfile();
    }
    getEventsList();
    getPlacesList();
  }

  render() {
    return (
      <div>
        <HeadBar />
        <main>
          <Switch>
            <Route
              exact
              path="/"
              component={Home}
            />
            <Route
              exact
              path="/profile"
              component={Profile}
            />
            <Route
              exact
              path="/event/:slug"
              component={Event}
            />
            <Route
              exact
              path="/search"
              component={SearchResult}
            />
            <Route
              exact
              path="/place/:slug"
              component={Place}
            />
            {/* Error 404 or 403 */}
            <Route component={Error} />
          </Switch>
        </main>
        <Footer />
      </div>
    );
  }
}


/**
 * Export
 */
export default App;
