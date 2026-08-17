<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Tag;
use App\Entity\Role;
use App\Entity\Event;
use App\Entity\Place;
use App\Entity\AppUser;
use App\Entity\Comment;
use App\Entity\Message;
use App\Entity\EventType;
use App\Entity\PlaceType;
use App\Entity\ArtistType;
use Faker\ORM\Doctrine\Populator;

use App\DataFixtures\Faker\TagProvider;
use App\DataFixtures\Faker\EventProvider;
use App\DataFixtures\Faker\PlaceProvider;
use App\DataFixtures\Faker\ArtistProvider;
use App\DataFixtures\Faker\EventTypeProvider;
use App\DataFixtures\Faker\PlaceTypeProvider;
use App\DataFixtures\Faker\ArtistTypeProvider;

use Doctrine\Bundle\FixturesBundle\Fixture;

use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture {

    private $encoder;

    public function __construct(UserPasswordHasherInterface $encoder){
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager) {
           
        $generator = Faker\Factory::create('fr_FR');

        $roleAdmin = New Role();
        $roleAdmin->setCode('ROLE_ADMINISTRATOR');
        $roleAdmin->setName('Administrateur');
        
        $roleModerator = New Role();
        $roleModerator->setCode('ROLE_MODERATOR');
        $roleModerator->setName('Moderateur');

        $roleUser = New Role();
        $roleUser->setCode('ROLE_USER');
        $roleUser->setName('Utilisateur');

        $roleArtist = New Role();
        $roleArtist->setCode('ROLE_ARTIST');
        $roleArtist->setName('Artiste');

        $roleOrganizer = New Role();
        $roleOrganizer->setCode('ROLE_ORGANIZER');
        $roleOrganizer->setName('Organiseur');

        $manager->persist($roleAdmin);
        $manager->persist($roleModerator);
        $manager->persist($roleUser);
        $manager->persist($roleArtist);
        $manager->persist($roleOrganizer);

        $manager->persist($this->createDemoUser('admin', 'admin@example.com', 'oculture', $roleAdmin));
        $manager->persist($this->createDemoUser('moderator', 'moderator@example.com', 'oculture', $roleModerator));
        $manager->persist($this->createDemoUser('user', 'user@example.com', 'oculture', $roleUser));

        $userArtist = $this->createDemoUser('artist', 'artist@example.com', 'oculture', $roleArtist);
        $userArtist->setName('Artist Test');
        $manager->persist($userArtist);

        $userOrganizer = $this->createDemoUser('organizer', 'organizer@example.com', 'oculture', $roleOrganizer);
        $userOrganizer->setName('Organizer Test');
        $manager->persist($userOrganizer);

        if (!class_exists(\Faker\ORM\Doctrine\Populator::class)) {
            $manager->flush();
            return;
        }

        $generator->addProvider(new ArtistProvider($generator));
        $generator->addProvider(new ArtistTypeProvider($generator));
        $generator->addProvider(new EventProvider($generator));
        $generator->addProvider(new EventTypeProvider($generator));
        $generator->addProvider(new PlaceTypeProvider($generator));
        $generator->addProvider(new PlaceProvider($generator));
        $generator->addProvider(new TagProvider($generator));
        
        $populator = new Faker\ORM\Doctrine\Populator($generator, $manager);
        
        $populator->addEntity('App\Entity\ArtistType', 4, array(
            'name' => function() use($generator) { return $generator->unique()->artistTypeName();},
        ));

        $demoHash = password_hash('oculture', PASSWORD_BCRYPT, ['cost' => 13]);
        $populator->addEntity('App\Entity\AppUser', 12, array(
            'username' => function() use($generator) { return $generator->unique()->artistName();},
            'email' => function() use($generator) { return $generator->unique()->userName().'@example.com';},
            'password' => function() use($demoHash) { return $demoHash;},
            'description' => function() use($generator) { return $generator->sentence($nbWords = 50, $variableNbWords = true);},
            'city' => function() use($generator) { return $generator->randomElement($array = array ('Paris','Lyon','Toulouse', 'Marseille', 'Bayonne', 'Strasbourg'));},
            'website' => function() use($generator) { return 'example.com';},
            'zipcode' => 75000,
            'status' => 1,
        ));
        
        $populator->addEntity('App\Entity\Tag', 10, array(
            'name' => function() use($generator) { return $generator->unique()->tagName();},
        ));

        $populator->addEntity('App\Entity\PlaceType', 5, array(
            'name' => function() use($generator) { return $generator->unique()->placeTypeName();},
        ));

        /*$populator->addEntity('App\Entity\Place', 4, array(
            'name' => function() use($generator) { return $generator->unique()->placeName();},
            'zipcode' => function() use($generator) { return $generator->postcode;},
        ));*/


        $populator->addEntity('App\Entity\EventType', 4, array(
            'name' => function() use($generator) { return $generator->unique()->eventTypeName();},
        ));
        
        $populator->addEntity('App\Entity\Event', 30, array(
            'name' => function() use($generator) { return $generator->unique()->eventName();},
            'nbSpectator' => function() use($generator) { return $generator->numberBetween($min = 30, $max = 500);},
            'description' => function() use($generator) { return $generator->sentence($nbWords = 50, $variableNbWords = true);},
            'price' => function() use($generator) { return $generator->numberBetween($min = 0, $max = 40);},
            'plannedDate' => function() use($generator) { return $generator->dateTimeThisYear($max = 'now', $timezone = null);},
        ));
        
        $populator->addEntity('App\Entity\Comment', 30, array(
            'content' => function() use($generator) { return $generator->sentence($nbWords = 15, $variableNbWords = true);},
            'nbLikes' => function() use($generator) { return $generator->numberBetween($min = 0, $max = 8);},
        ));

        $inserted = $populator->execute();
        $manager->flush();

    }

    /**
     * Builds a demo account with a bcrypt-hashed password.
     */
    private function createDemoUser(string $username, string $email, string $plainPassword, Role $role): AppUser
    {
        $user = new AppUser();
        $user->setUsername($username);
        $user->setEmail($email);
        $user->setPassword($this->encoder->hashPassword($user, $plainPassword));
        $user->setRole($role);
        $user->setCity('Paris');
        $user->setZipcode(75000);
        $user->setStatus(1);

        return $user;
    }
}