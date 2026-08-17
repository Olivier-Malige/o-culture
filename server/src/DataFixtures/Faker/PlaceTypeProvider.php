<?php

namespace App\DataFixtures\Faker;

class PlaceTypeProvider extends \Faker\Provider\Base {

    protected static $placeTypeName = [
      'Bar',
      'Café',
      'Salle de spectacle',
      'Shop',
      'Restaurant',
    ];

    public static function placeTypeName(){
        return static::randomElement(self::$placeTypeName);
    }

}
