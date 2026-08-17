<?php

namespace App\DataFixtures\Faker;

class PlaceProvider extends \Faker\Provider\Base {

    protected static $placeName = [
      'Milk Shop',
      'Le Victoria',
      'Le Surfing',
      'Bleu Café',
    ];

    public static function placeName(){
        return static::randomElement(self::$placeName);
    }

    protected static $placeDescription = [
      'Café-concert. Petite scène, bonne acoustique, plats simples le midi.',
      'Salle pour concerts et expos. Bar ouvert dès 18h.',
      'Programmation mixte, du jazz au théâtre.',
      'Café culturel. Expos, lectures et petits concerts le week-end.',
    ];

    /**
     * Short French demo copy for a venue.
     */
    public static function placeDescription(){
        return static::randomElement(self::$placeDescription);
    }

}
