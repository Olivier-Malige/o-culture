/**
 * Import
 */
import React from 'react';
import PropTypes from 'prop-types';
import { v4 as uuidv4 } from 'uuid';

/**
 * Local import
 */
// Components
import Card from 'src/components/Card';
import Comments from 'src/containers/Comments/Comments';
import { assetUrl } from 'src/utils/asset';

// Styles and assets
import './place.sass';
import Welcome from 'src/components/Templates/One';
/**
 * Code
 */
class Place extends React.Component {
  static propTypes = {
    currentPlace: PropTypes.object.isRequired,
    events: PropTypes.array.isRequired,
    comments: PropTypes.array.isRequired,
    getPlace: PropTypes.func.isRequired,
    match: PropTypes.object.isRequired,
  }

  componentWillMount() {
    // Get current place with convert slug (router) into id
    const { getPlace, match } = this.props;
    getPlace(Number(match.params.slug));
  }

  render() {
    const { currentPlace, events, comments } = this.props;
    return (
      <div>
        <Welcome
          image={assetUrl(currentPlace.image)}
          title={currentPlace.name}
          titleClassName="animated bounce"
        />
        <div id="place">
          <div className="place">
            <div className="place-events">
              <div className="place-title">Événement à venir</div>
              <section className="cards">
                {events.map(elem => (
                  <Card
                    id={Number(currentPlace.id)}
                    key={uuidv4()}
                    date={elem.planned_date}
                    place={{ city: currentPlace.city, name: currentPlace.name }}
                    {...elem}
                  />
                ))}
              </section>
            </div>
            <div className="place-comments">
              <div className="place-title">Commentaires</div>
              <Comments pageId={currentPlace.id} comments={comments} pageType="Comment" />
            </div>
          </div>
          <div className="place-resume">
            <h1>{currentPlace.name}</h1>
            <p>{currentPlace.description}</p>
            <ul>
              <li>{currentPlace.city}</li>
              <li>{currentPlace.zipcode}</li>
              <li>{currentPlace.email}</li>
              <li>{currentPlace.website}</li>
            </ul>
          </div>
        </div>
      </div>
    );
  }
}

/**
 * Export
 */
export default Place;
