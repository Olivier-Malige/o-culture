import React from 'react';

import Suggestions from './Suggestions';

class Search extends React.Component {
  handleChange = (evt) => {
    const { onInputChange } = this.props;
    onInputChange(evt.target.value);
  }

  handleSubmit = (evt) => {
    const { submit } = this.props;
    evt.preventDefault();
    if (evt.target && evt.target.querySelector) {
      const input = evt.target.querySelector('input');
      if (input) {
        input.blur();
      }
    }
    if (submit) {
      submit();
    }
  }

  render() {
    const { query, results } = this.props;
    const showResults = query && query.trim().length >= 2;

    return (
      <div className="search-bar">
        <form
          className="search-bar--form"
          onSubmit={this.handleSubmit}
        >
          <div className="search-bar--form--icon_search" />
          <input
            value={query}
            onChange={this.handleChange}
            className="search-bar--form--input"
            placeholder="Rechercher un événement, un artiste, un lieu"
            autoComplete="off"
          />
        </form>
        {showResults && (
          <div className="search-bar--results">
            <Suggestions results={results} />
          </div>
        )}
      </div>
    );
  }
}

export default Search;
