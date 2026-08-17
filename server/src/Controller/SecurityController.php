<?php

namespace App\Controller;

use App\Entity\AppUser;
use FOS\RestBundle\View\View;
use App\Repository\RoleRepository;
use App\Repository\AppUserRepository;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializationContext;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\Controller\Annotations as FOSRest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends Controller
{

    /**
     * Inscription.
     * @FOSRest\Post("/api/registration")
     * 
     *
     * 
     */
    public function registration(AppUserRepository $repository ,Request $request, RoleRepository $roleRepository, ObjectManager $em, UserPasswordEncoderInterface $encoder)
    {
        $serializer = SerializerBuilder::create()->build();
        // je récupère l'username et l'email venant de la requete (données du formulaire)
        $username = trim(htmlspecialchars($request->get('username')));
        $email = trim(htmlspecialchars((strtolower($request->get('email')))));
        // je cherche en base de donnée si ils existent 
        $emailSearch = $repository->findByEmail($email);
        $usernameSearch = $repository->findByUsername($username);

        // si l'email et l'username existent alors renvoi d'une réponse a react avec un status false et la raison
        if (!empty($emailSearch) && !empty($usernameSearch)) {

            $jsonContent = $serializer->serialize(['status'=> false ,'error' => 3 , 'message'=> 'email and username already exist'], 'json');
            $response = new Response($jsonContent, Response::HTTP_OK);
            return $response;

        }
        // si l'username existe alors renvoi d'une réponse a react avec un status false et la raison
        else if (!empty($usernameSearch) ) {
            
            $jsonContent = $serializer->serialize(['status'=> false ,'error'=> 2 , 'message'=> 'username already exists'], 'json');
            $response = new Response($jsonContent, Response::HTTP_OK);
            return $response;
            
        }
        // si l'email  existe alors renvoi d'une réponse a react avec un status false et la raison
        else if (!empty($emailSearch) ) {

            $jsonContent = $serializer->serialize(['status'=> false , 'error' => 1 ,'message'=> 'email already exists'], 'json');
            $response = new Response($jsonContent, Response::HTTP_OK);
            return $response;

        } 
        else {

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
            }
            else if ($request->get('acount') === "organizer") {
                $role = $roleRepository->findByRoleUser('ROLE_ORGANIZER');
                // je récupère le role Organizer si l'utilisateur veut s'enregistrer en tant qu'organisateur
                $roleUser = $role[0];
                $appUser = new AppUser();
                $appUser->setFacebook(trim(htmlspecialchars($request->get('facebook'))));
                $appUser->setTwitter(trim(htmlspecialchars($request->get('twitter'))));
                $appUser->setWebsite(trim(htmlspecialchars($request->get('website'))));
                $appUser->setDescription(trim(htmlspecialchars($request->get('description'))));
                $appUser->setStatus(3);
            }
            else {
                $role = $roleRepository->findByRoleUser('ROLE_SPECTATOR');
                if (empty($role)) {
                    $role = $roleRepository->findByRoleUser('ROLE_USER');
                }
                // je récupère le role USer si l'utilisateur veut s'enregistrer en tant que spectateur
                $roleUser = $role[0];
                $appUser = new AppUser();
                $appUser->setStatus(1);
            }
    
            $password = $request->get('password');
            
            $hash = $encoder->encodePassword($appUser, $password);
            
    
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
    
            $jsonContent = $serializer->serialize(['status' => true, 'error' => 0, 'message' => 'user created'], 'json');
            $response = new Response($jsonContent, Response::HTTP_OK);
            return $response;
        }
        
    }

    /**
     * Search email.
     * @FOSRest\Post("/api/searchByEmail")
     * 
     *
     * 
     */
    public function searchByEmail(Request $request, AppUserRepository $repository)
    {
        $serializer = SerializerBuilder::create()->build();
        $email = $repository->findByEmail(trim(htmlspecialchars(strtolower($request->get('email')))));
        if(empty($email)) {

            $jsonContent = $serializer->serialize(['status' => false, 'error' => 0, 'message' => 'email does not exist'], 'json');
            $response = new Response($jsonContent, Response::HTTP_OK);
            return $response;

        }
        $jsonContent = $serializer->serialize(['status' => true, 'error' => 1, 'message' => 'email already exists'], 'json');
        $response = new Response($jsonContent, Response::HTTP_OK);
        return $response;

    }
    /**
     * Search username.
     * @FOSRest\Post("/api/searchByUsername")
     * 
     *
     * 
     */
    public function searchByUsername(Request $request, AppUserRepository $repository)
    {
        $serializer = SerializerBuilder::create()->build();
        $username = $repository->findByUsername(trim(htmlspecialchars($request->get('username'))));
        if(empty($username)) {
            $jsonContent = $serializer->serialize(['status' => false, 'error' => 0, 'message' => 'username does not exist'], 'json');
            $response = new Response($jsonContent, Response::HTTP_OK);
            return $response; 
        }
        $jsonContent = $serializer->serialize(['status' => true, 'error' => 2, 'message' => 'username already exists'], 'json');
        $response = new Response($jsonContent, Response::HTTP_OK);
        return $response;
    

    }

    
}
