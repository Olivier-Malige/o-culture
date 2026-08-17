<?php

namespace App\DataFixtures\Faker;

class ArtistProvider extends \Faker\Provider\Base {

    protected static $artistName = [
      'The Bakers',
      'Queens of Lions',
      'MJC des Quais',
      'The Richards',
      'Compagnie des artistes',
      'Troupe des solistes',
      'The Fordmums & Sisters',
      'Monesim Nani',
      'Si et Compagnie',
      'Collectif des danseurs',
      'The Flying Ears',
      'Danse Compagnie',
    ];

    public static function artistName(){
        return static::randomElement(self::$artistName);
    }

    protected static $artistDescription = [
      'Groupe local : concerts intimistes ou sets plus énergiques, selon la salle.',
      'Duo pop-folk. Reprises et morceaux originaux, souvent en acoustique.',
      'Troupe de chant et de danse. Spectacles courts, tout public.',
      'Groupe rock. Première partie ou tête d’affiche, selon les dates.',
      'Quatuor jazz. Standards et compositions, plutôt le soir.',
      'Maison de quartier. Ateliers, concerts et sorties pour tous les âges.',
      'Compagnie de danse contemporaine. Créations courtes et stages ouverts.',
      'Troupe de théâtre. Classique et textes contemporains.',
      'Collectif de danseurs. Hip-hop, contemporain et jam sessions.',
      'Compagnie pluridisciplinaire. Musique, théâtre et expos photos.',
    ];

    /**
     * Short French demo bio for an artist or organizer.
     */
    public static function artistDescription(){
        return static::randomElement(self::$artistDescription);
    }

}
