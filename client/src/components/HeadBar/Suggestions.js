import React from 'react';
import { Link } from 'react-router-dom';
import { v4 as uuidv4 } from 'uuid';

const asList = (value) => (Array.isArray(value) ? value : []);

const label = (item) => item.name || item.username || 'Sans nom';

const Suggestions = ({ results = {} }) => {
  const artists = asList(results.artists).slice(0, 4);
  const events = asList(results.events).slice(0, 4);
  const places = asList(results.places).slice(0, 4);
  const hasResults = artists.length + events.length + places.length > 0;

  if (!hasResults) {
    return (
      <div className="search-bar--results_empty">Aucun résultat</div>
    );
  }

  return (
    <React.Fragment>
      {artists.length > 0 && (
        <React.Fragment>
          <div className="search-bar--results_type">Artistes</div>
          <ul>
            {artists.map(item => (
              <li key={item.id || uuidv4()}>{label(item)}</li>
            ))}
          </ul>
        </React.Fragment>
      )}
      {events.length > 0 && (
        <React.Fragment>
          <div className="search-bar--results_type">Événements</div>
          <ul>
            {events.map(item => (
              <li key={item.id || uuidv4()}>
                <Link to={`/event/${item.id}`} onMouseDown={evt => evt.preventDefault()}>
                  {label(item)}
                </Link>
              </li>
            ))}
          </ul>
        </React.Fragment>
      )}
      {places.length > 0 && (
        <React.Fragment>
          <div className="search-bar--results_type">Lieux</div>
          <ul>
            {places.map(item => (
              <li key={item.id || uuidv4()}>
                <Link to={`/place/${item.id}`} onMouseDown={evt => evt.preventDefault()}>
                  {label(item)}
                </Link>
              </li>
            ))}
          </ul>
        </React.Fragment>
      )}
    </React.Fragment>
  );
};

export default Suggestions;
