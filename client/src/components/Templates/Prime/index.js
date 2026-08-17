import React from 'react';

import SubPrime from './SubPrime';

import 'src/components/Templates/Prime/prime.sass';

class Prime extends React.Component {
  state = {
    list: {
      title: "Établissements musicaux",
      subtitle: "Lieux mythiques, petits et grands",
      tiles: {
        one: {
          id: 1,
          image: '/src/assets/places/concert-1958517_1920.jpg',
          phrase: 'Grandes salles, grand moment',
          sentence: 'Vivez une expérience unique dans ces espaces taillés sur-mesure.',
        },
        two: {
          id: 2,
          image: '/src/assets/places/beerta-maini-418390-unsplash.jpg',
          phrase: 'Petite salle, émotions quintuplés',
          sentence: 'Passez un bon moment entre amis et découvrez de grand talent dans des lieux uniques.',
        },
      },
    },
  };

  render() {
    const list = this.state.list;

    return (
      <section className="section slider">
        <SubPrime tiles={list} />
      </section>
    );
  }
}

/**
 * Export
 */
export default Prime;
