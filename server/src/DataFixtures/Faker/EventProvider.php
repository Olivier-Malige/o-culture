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

    protected static $eventDescription = [
      'Une heure de spectacle, tout public. Bar ouvert dès 18h.',
      'Entrée libre pour les moins de 12 ans. Places limitées.',
      'Décors simples, jeu vif. Échanges avec l’équipe après la représentation.',
      'Visite libre. L’artiste est présent le week-end.',
      'Trois sets de 20 minutes. Programmation locale.',
      'Atelier le samedi après-midi, sur inscription à l’entrée.',
      'Ambiance café-théâtre. On peut proposer des thèmes.',
      'Piste dégagée pour danser. Bouchons d’oreilles à disposition.',
    ];

    /**
     * Short French demo copy for an event.
     */
    public static function eventDescription(){
        return static::randomElement(self::$eventDescription);
    }

    protected static $commentContent = [
      'Très belle soirée, on revient.',
      'Bonne salle, un peu sonore près de la scène.',
      'Accessible même si on n’y connaît rien.',
      'Accueil sympa, on voit bien depuis le fond.',
      'Un peu long entre les sets, sinon nickel.',
      'Programmation régulière, on y va souvent.',
      'Prenez des bouchons, ça envoie.',
      'À voir. Les photos sont justes.',
    ];

    /**
     * Short French demo comment.
     */
    public static function commentContent(){
        return static::randomElement(self::$commentContent);
    }

}
