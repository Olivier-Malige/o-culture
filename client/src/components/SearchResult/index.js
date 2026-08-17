/**
 * Import
 */
import React from 'react';
import { connect } from 'react-redux';
import { Link } from 'react-router-dom';

/**
 * Local import
 */
import Card from 'src/components/Card';
import './searchResult.sass';

/**
 * Returns a list even when the API sends an empty-result object.
 */
const asList = (value) => (Array.isArray(value) ? value : []);

const SearchResult = ({ query, results }) => {
  const artists = asList(results.artists);
  const events = asList(results.events);
  const places = asList(results.places);
  const empty = artists.length + events.length + places.length === 0;

  return (
    <div id="searchResult" className="section">
      <h1>Recherche{query ? ` : ${query}` : ''}</h1>
      {empty && (
        <p className="search-empty">Aucun résultat. Tapez au moins 2 caractères dans la barre de recherche.</p>
      )}
      {events.length > 0 && (
        <section>
          <h2>Événements</h2>
          <div className="cards">
            {events.map(item => (
              <Card
                key={item.id}
                id={item.id}
                name={item.name}
                image={item.image}
                date={item.planned_date}
                place={item.event_place}
              />
            ))}
          </div>
        </section>
      )}
      {places.length > 0 && (
        <section>
          <h2>Lieux</h2>
          <ul className="search-list">
            {places.map(item => (
              <li key={item.id}>
                <Link to={`/place/${item.id}`}>{item.name}</Link>
              </li>
            ))}
          </ul>
        </section>
      )}
      {artists.length > 0 && (
        <section>
          <h2>Artistes</h2>
          <ul className="search-list">
            {artists.map(item => (
              <li key={item.id}>{item.name || item.username}</li>
            ))}
          </ul>
        </section>
      )}
    </div>
  );
};

const mapStateToProps = state => ({
  query: state.data.search.query,
  results: state.data.search.results,
});

export default connect(mapStateToProps)(SearchResult);
