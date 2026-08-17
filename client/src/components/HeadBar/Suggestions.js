import React from 'react';
import { Link } from 'react-router-dom';
import { v4 as uuidv4 } from 'uuid';

const Suggestions = ({ results }) => {
  // console.log(uuidv4());
  return (
    <React.Fragment>
      {
        results.artists && results.artists.status != false
        && (
          <React.Fragment>
            <div className="search-bar--results_type">Artistes</div>
            <ul>{results.artists.slice(0, 4).map(r => (
              <Link to={`/artist/${r.id}`}>
                <li key={uuidv4()}>
                  {r.name}
                </li>
              </Link>))}
            </ul>
          </React.Fragment>
        )
      }

      {
        results.events && results.events.status != false
        && (
          <React.Fragment>
            <div className="search-bar--results_type">Événements</div>
            <ul>{results.events.slice(0, 4).map(r => (
              <Link to={`/event/${r.id}`}>
                <li key={uuidv4()}>
                  {r.name}
                </li>
              </Link>))}
            </ul>
          </React.Fragment>
        )
      }

      {
        results.places && results.places.status != false
        && (
          <React.Fragment>
            <div className="search-bar--results_type">Lieux</div>
            <ul>{results.places.slice(0, 4).map(r => (
              <Link to={`/place/${r.id}`}>
                <li key={uuidv4()}>
                  {r.name}
                </li>
              </Link>))}
            </ul>
          </React.Fragment>
        )
      }

      <div className="search-bar--form--icon_close" />
    </React.Fragment>
  );
};

export default Suggestions;
