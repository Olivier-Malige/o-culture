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

}
