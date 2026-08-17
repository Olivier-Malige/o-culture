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

}
