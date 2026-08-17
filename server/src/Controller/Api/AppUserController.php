<?php

namespace App\Controller\Api;

use App\Entity\AppUser;
use App\Form\AppUserType;
use JMS\Serializer\SerializationContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\BaseController;




class AppUserController extends BaseController
{
    /**
     * Lists all AppUsers.
     * @Route("/api/appusers", methods={"GET"})
     * 
     *
     * 
     */
    public function getAppUsers()
    {

        if (!$this->isGranted('ROLE_ADMINISTRATOR')) {
            return new JsonResponse(['message' => "Vous n'avez pas accès a cette page"], 403);
        }

        $repository = $this->getDoctrine()->getRepository(AppUser::class);
        $users = $repository->findall();
        $serializer = $this->container->get('jms_serializer');
        $jsonContent = $serializer->serialize($users, 'json', SerializationContext::create()->setGroups(array('appuser_list')));
        return new Response($jsonContent, Response::HTTP_OK);
    }

    /**
     * Lists all Artiste.
     * @Route("/api/artists", methods={"GET"})
     * 
     *
     * 
     */
    public function getArtists()
    {
        $repository = $this->getDoctrine()->getRepository(AppUser::class);


        $artists = $repository->findByStatus(2);
        $serializer = $this->container->get('jms_serializer');
        $jsonContent = $serializer->serialize($artists, 'json', SerializationContext::create()->setGroups(array('appuser_a_detail')));
        return new Response($jsonContent, Response::HTTP_OK);
    }
    /**
     * One AppUser.
     * @Route("/api/appusers/{username}", methods={"GET"})
     *
     * 
     */
    public function getAppUser(AppUser $appUser)
    {
        $user = $this->getUser();
        if (!$user) {
            return new JsonResponse(['message' => 'Non authentifié'], Response::HTTP_UNAUTHORIZED);
        }

        $isOwner = $appUser->getUsername() === $user->getUsername();
        $isArtist = $appUser->getRole() && $appUser->getRole()->getCode() === 'ROLE_ARTIST';
        if ($isOwner || $isArtist) {
            return $this->profileResponse($appUser);
        }

        return new JsonResponse(['message' => "Vous n'avez pas accès a ce profile"], 401);
    }

    /**
     * Current authenticated user profile, including event registrations.
     * @Route("/api/me", methods={"GET"})
     */
    public function getMe()
    {
        $user = $this->getUser();
        if (!$user instanceof AppUser) {
            return new JsonResponse(['message' => 'Non authentifié'], Response::HTTP_UNAUTHORIZED);
        }

        $freshUser = $this->getDoctrine()->getRepository(AppUser::class)->find($user->getId());
        $profileUser = $freshUser ?: $user;
        $profileUser->getEventsParticipant()->toArray();

        return $this->profileResponse($profileUser);
    }

    /**
     * Serialize a user profile with events nested for the React profile page.
     */
    private function profileResponse(AppUser $appUser): Response
    {
        $role = $appUser->getRole() ? $appUser->getRole()->getCode() : 'ROLE_USER';
        $groups = array('appuser_detail', 'event_list');
        if ($role === 'ROLE_ORGANIZER') {
            $groups[] = 'appuser_a_o_detail';
            $groups[] = 'appuser_o_detail';
        } elseif ($role === 'ROLE_ARTIST') {
            $groups[] = 'appuser_a_o_detail';
            $groups[] = 'appuser_a_detail';
        }

        $serializer = $this->container->get('jms_serializer');
        $jsonContent = $serializer->serialize($appUser, 'json', SerializationContext::create()->setGroups($groups));
        $response = new Response($jsonContent, Response::HTTP_OK);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

       
    /**
    * @Route("/api/appusers/{username}", methods={"PUT"})
    */
    public function updateAppUser(Request $request, AppUser $appUser, UserPasswordHasherInterface $encoder)
    {
        $user = $this->getUser();
        if (!$user instanceof AppUser || $user->getId() !== $appUser->getId()) {
            return new JsonResponse(['message' => 'Non autorisé'], Response::HTTP_FORBIDDEN);
        }

        if (empty($request->get('facebook'))) {
            $facebook = $user->getFacebook();
        } else {
            $facebook = (trim(htmlspecialchars($request->get('facebook'))));
        }

        if (empty($request->get('twitter'))) {
            $twitter = $user->getTwitter();
        } else {
            $twitter = trim(htmlspecialchars($request->get('twitter')));
        }

        if (empty($request->get('website'))) {
            $website = $user->getWebsite();
        } else {
            $website = trim(htmlspecialchars($request->get('website')));
        }
        
        if (empty($request->get('description'))) {
            $description = $user->getDescription();
        } else {
            $description = trim(htmlspecialchars($request->get('description')));
        }    

        if(empty($request->get('name'))) {
            $name = $user->getUsername();
        } else {
            $name = trim(htmlspecialchars($request->get('name')));
        }

        if(empty($request->get('password'))) {
            $password = $user->getPassword();
        } else {
            $plainPassword = (string) $request->get('password');
            if (strlen($plainPassword) < 8) {
                return new JsonResponse(['message' => 'Mot de passe trop court'], Response::HTTP_BAD_REQUEST);
            }
            $password = $encoder->hashPassword($appUser, $plainPassword);
        }

        if(empty($request->get('city'))) {
            $city = $user->getCity();
        } else {
            $city = trim(htmlspecialchars(strtoupper($request->get('city'))));
        }

        if(empty($request->get('zipcode'))) {
            $zipcode = $user->getZipcode();
        } else {
            $zipcode = trim(htmlspecialchars(($request->get('zipcode'))));
        }

        if(empty($appUser)) {
            return new JsonResponse(['message' => 'User not found'], Response::HTTP_NOT_FOUND);
        }
      
        if(empty($user)) {

            return new JsonResponse(['message' => 'Utilisateur non modifié !'], Response::HTTP_OK);
        }
        else {

            $user->setName($name);
            $user->setPassword($password);
            $user->setCity($city);
            $user->setZipcode($zipcode);
            $user->setFacebook($facebook);
            $user->setTwitter($twitter);
            $user->setWebsite($website);
            $user->setDescription($description);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return new JsonResponse(['message' => 'Utilisateur modifié !'], Response::HTTP_OK);
        }              
            
    }

}

