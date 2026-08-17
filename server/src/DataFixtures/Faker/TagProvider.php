<?php

namespace App\DataFixtures\Faker;

class TagProvider extends \Faker\Provider\Base {

    protected static $tagName = [
      'Rock',
      'Contemporrain',
      'Folk',
      'Metal',
      'Jeunesse',
      'Photographie',
      'Sculpture',
      'Peinture',
      'Classique',
      'Jazz',
    ];

    public static function tagName(){
        return static::randomElement(self::$tagName);
    }

}
