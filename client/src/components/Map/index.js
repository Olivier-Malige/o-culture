import React from 'react';
import PropTypes from 'prop-types';

import './map.sass';

const markerIcons = {
  iconRetinaUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon-2x.png',
  iconUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon.png',
  shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
};

/**
 * Wait until Leaflet is available on window (CDN script in index.html).
 */
const whenLeafletReady = (done) => {
  if (window.L) {
    done(window.L);
    return;
  }
  let tries = 0;
  const timer = window.setInterval(() => {
    tries += 1;
    if (window.L || tries > 40) {
      window.clearInterval(timer);
      if (window.L) {
        done(window.L);
      }
    }
  }, 50);
};

/**
 * Displays an OpenStreetMap view for a postal address.
 */
class PlaceMap extends React.Component {
  container = React.createRef();

  requestId = 0;

  componentDidMount() {
    this.loadMap();
  }

  componentDidUpdate(prevProps) {
    const { adress, city, zipcode } = this.props;
    if (prevProps.adress !== adress || prevProps.city !== city || prevProps.zipcode !== zipcode) {
      this.loadMap();
    }
  }

  componentWillUnmount() {
    this.requestId += 1;
    this.destroyMap();
  }

  query() {
    const { adress, city, zipcode } = this.props;
    const parts = [adress, zipcode, city].filter(Boolean);
    if (!parts.length) {
      return '';
    }
    return parts.concat('France').join(' ');
  }

  fallbackQuery() {
    const { city, zipcode } = this.props;
    return [zipcode, city, 'France'].filter(Boolean).join(' ');
  }

  destroyMap() {
    if (this.map) {
      this.map.remove();
      this.map = null;
    }
  }

  loadMap() {
    const query = this.query();
    if (!this.container.current || !query) {
      this.destroyMap();
      return;
    }

    this.destroyMap();
    const requestId = this.requestId + 1;
    this.requestId = requestId;
    const fallback = this.fallbackQuery();
    const city = this.props.city || '';

    whenLeafletReady((leaflet) => {
      if (requestId !== this.requestId || !this.container.current) {
        return;
      }
      leaflet.Icon.Default.mergeOptions(markerIcons);
      fetch(`/api/geocode?q=${encodeURIComponent(query)}&fallback=${encodeURIComponent(fallback)}&city=${encodeURIComponent(city)}`)
        .then(response => response.json())
        .then((coords) => {
          if (requestId !== this.requestId || !this.container.current || !coords || !coords.lat) {
            return;
          }
          this.map = leaflet.map(this.container.current, { scrollWheelZoom: false })
            .setView([coords.lat, coords.lon], 15);
          leaflet.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap',
            maxZoom: 19,
          }).addTo(this.map);
          leaflet.marker([coords.lat, coords.lon]).addTo(this.map);
          window.setTimeout(() => {
            if (this.map) {
              this.map.invalidateSize();
            }
          }, 200);
        })
        .catch(() => {});
    });
  }

  render() {
    if (!this.query()) {
      return null;
    }

    return <div className="place-map" ref={this.container} />;
  }
}

PlaceMap.propTypes = {
  adress: PropTypes.string,
  city: PropTypes.string,
  zipcode: PropTypes.oneOfType([PropTypes.string, PropTypes.number]),
};

PlaceMap.defaultProps = {
  adress: '',
  city: '',
  zipcode: '',
};

export default PlaceMap;
