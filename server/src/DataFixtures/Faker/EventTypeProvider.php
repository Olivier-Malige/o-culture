<?php

namespace App\DataFixtures\Faker;

class EventTypeProvider extends \Faker\Provider\Base {

    protected static $eventTypeName = [
      'Musique',
      'Théâtre',
      'Danse',
      'Exposition',
    ];

    public static function eventTypeName(){
        return static::randomElement(self::$eventTypeName);
    }

}
