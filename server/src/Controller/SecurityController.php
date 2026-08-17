<?php

namespace App\Controller;

use App\Entity\AppUser;
use App\Repository\RoleRepository;
use App\Repository\AppUserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class SecurityController extends BaseController
{
    /**
     * Inscription.
     * @Route("/api/registration", methods={"POST"})
     */
    public function registration(AppUserRepository $repository, Request $request, RoleRepository $roleRepository, UserPasswordHasherInterface $encoder)
    {
        // je récupère l'username et l'email venant de la requete (données du formulaire)
        $username = trim(htmlspecialchars($request->get('username')));
        $email = trim(htmlspecialchars((strtolower($request->get('email')))));
        // je cherche en base de donnée si ils existent
        $emailSearch = $repository->findByEmail($email);
        $usernameSearch = $repository->findByUsername($username);

        // si l'email et l'username existent alors renvoi d'une réponse a react avec un status false et la raison
        if (!empty($emailSearch) && !empty($usernameSearch)) {
            return $this->serializeJson(['status'=> false ,'error' => 3 , 'message'=> 'email and username already exist']);
        }
        // si l'username existe alors renvoi d'une réponse a react avec un status false et la raison
        if (!empty($usernameSearch)) {
            return $this->serializeJson(['status'=> false ,'error'=> 2 , 'message'=> 'username already exists']);
        }
        // si l'email  existe alors renvoi d'une réponse a react avec un status false et la raison
        if (!empty($emailSearch)) {
            return $this->serializeJson(['status'=> false , 'error' => 1 ,'message'=> 'email already exists']);
        }

        if ($request->get('acount') === "artist") {
            $role = $roleRepository->findByRoleUser('ROLE_ARTIST');
            // je récupère le role Artist si l'utilisateur veut s'enregistrer en tant qu'artiste
            $roleUser = $role[0];
            $appUser = new AppUser();
            $appUser->setFacebook(trim(htmlspecialchars($request->get('facebook'))));
            $appUser->setTwitter(trim(htmlspecialchars($request->get('twitter'))));
            $appUser->setWebsite(trim(htmlspecialchars($request->get('website'))));
            $appUser->setDescription(trim(htmlspecialchars($request->get('description'))));
            $appUser->setStatus(2);
        } else if ($request->get('acount') === "organizer") {
            $role = $roleRepository->findByRoleUser('ROLE_ORGANIZER');
            // je récupère le role Organizer si l'utilisateur veut s'enregistrer en tant qu'organisateur
            $roleUser = $role[0];
            $appUser = new AppUser();
            $appUser->setFacebook(trim(htmlspecialchars($request->get('facebook'))));
            $appUser->setTwitter(trim(htmlspecialchars($request->get('twitter'))));
            $appUser->setWebsite(trim(htmlspecialchars($request->get('website'))));
            $appUser->setDescription(trim(htmlspecialchars($request->get('description'))));
            $appUser->setStatus(3);
        } else {
            $role = $roleRepository->findByRoleUser('ROLE_SPECTATOR');
            if (empty($role)) {
                $role = $roleRepository->findByRoleUser('ROLE_USER');
            }
            // je récupère le role USer si l'utilisateur veut s'enregistrer en tant que spectateur
            $roleUser = $role[0];
            $appUser = new AppUser();
            $appUser->setStatus(1);
        }

        $password = (string) $request->get('password');
        if (strlen($password) < 8) {
            return $this->serializeJson(['status'=> false ,'error' => 4 , 'message'=> 'password too short']);
        }

        $hash = $encoder->hashPassword($appUser, $password);

        $appUser->setUsername($username);
        $appUser->setEmail($email);
        $appUser->setPassword($hash);
        $appUser->setName(trim(htmlspecialchars($request->get('name'))));
        $appUser->setCity(trim(htmlspecialchars(strtoupper($request->get('city')))));
        $appUser->setZipcode(trim(htmlspecialchars(($request->get('zipcode')))));
        $appUser->setRole($roleUser);

        $em = $this->getDoctrine()->getManager();
        $em->persist($appUser);
        $em->flush();

        return $this->serializeJson(['status' => true, 'error' => 0, 'message' => 'user created']);
    }

    /**
     * Search email.
     * @Route("/api/searchByEmail", methods={"POST"})
     */
    public function searchByEmail(Request $request, AppUserRepository $repository)
    {
        $email = $repository->findByEmail(trim(htmlspecialchars(strtolower($request->get('email')))));
        if (empty($email)) {
            return $this->serializeJson(['status' => false, 'error' => 0, 'message' => 'email does not exist']);
        }

        return $this->serializeJson(['status' => true, 'error' => 1, 'message' => 'email already exists']);
    }

    /**
     * Search username.
     * @Route("/api/searchByUsername", methods={"POST"})
     */
    public function searchByUsername(Request $request, AppUserRepository $repository)
    {
        $username = $repository->findByUsername(trim(htmlspecialchars($request->get('username'))));
        if (empty($username)) {
            return $this->serializeJson(['status' => false, 'error' => 0, 'message' => 'username does not exist']);
        }

        return $this->serializeJson(['status' => true, 'error' => 2, 'message' => 'username already exists']);
    }
}
