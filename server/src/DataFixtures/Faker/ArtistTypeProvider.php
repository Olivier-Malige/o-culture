<?php

namespace App\DataFixtures\Faker;

class ArtistTypeProvider extends \Faker\Provider\Base {

    protected static $artistTypeName = [
      'Troupe de théâtre',
      'Photographe',
      'Groupe',
      'Troupe de danse',
    ];

    public static function artistTypeName(){
        return static::randomElement(self::$artistTypeName);
    }

}
