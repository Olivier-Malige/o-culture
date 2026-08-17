import React from 'react';

import Suggestions from './Suggestions';

class Search extends React.Component {
  handleChange = (evt) => {
    const { onInputChange } = this.props;
    const { value } = evt.target;
    onInputChange(value);
  }

  render() {
    const { query, results, submit } = this.props;
    return (

      <div className="search-bar">
        <form
          className="search-bar--form"
          onSubmit={submit}
        >
          <div className="search-bar--form--icon_search" />
          <input
            value={query}
            onChange={this.handleChange}
            className="search-bar--form--input"
          />
        </form>
        <div className="search-bar--results">
          <Suggestions results={results} />
        </div>
      </div>
    );
  }
}

export default Search;
