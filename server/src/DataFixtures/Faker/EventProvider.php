<?php

namespace App\DataFixtures\Faker;

class EventProvider extends \Faker\Provider\Base {

    protected static $eventName = [
      'Exposition de photographie',
      'Concert de jazz',
      'Concert de rock',
      'Concert de funk',
      'Concert de metal',
      'Concert de folk',
      'Les quais du Rhône en photos',
      'Scènes musicales lyonnaises',
      'Humour : soirée d\'impro',
      'Lac d\'Annecy en photos',
      'Scènes musicales parisiennes',
      'Scènes musicales bordelaises',
      'Scènes musicales marseillaises',
      'Scènes musicales strasbourgeoises',
      'Photographie : le travail des artisans de la région',
      'Extraits de Molière',
      'Spectacle de danse moderne',
      'Spectacle de hip-hop',
      'Spectacle de danse classique',
      'Spectacle de danse africaine',
      'Exposition de sculpture',
      'Nuits théâtrales',
      'Guitare en solo',
      'Exposition : photos en noir et blanc',
      'Représentation des jeunes de l\'Association Tous en scène',
      'Soirée scène ouverte',
      'Théâtre : Mise en scène',
      'Exposition : paysages de la région',
      'Exposition : la région en bande-dessinée',
      'Sketchs : soirée d\'impro',
      'Scènes musicales',
    ];

    public static function eventName(){
        return static::randomElement(self::$eventName);
    }

}
