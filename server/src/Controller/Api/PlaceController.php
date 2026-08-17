<?php

namespace App\Controller\Api;

use App\Entity\Event;
use App\Entity\Place;
use App\Entity\AppUser;
use App\Entity\PlaceType;
use FOS\RestBundle\View\View;
use App\Repository\PlaceRepository;
use App\Repository\PlaceTypeRepository;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializationContext;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\Controller\Annotations as FOSRest;
use App\Entity\Comment;


class PlaceController extends FOSRestController
{
    /**
     * Lists all Places.
     * @FOSRest\Get("/api/places")
     */

    public function getPlaces()
    {
        $repository = $this->getDoctrine()->getRepository(Place::class);
    
        $places = $repository->findall();
        $serializer = SerializerBuilder::create()->build();
        $jsonContent = $serializer->serialize($places, 'json', SerializationContext::create()->setGroups(array('place_list', 'place_detail')));
        $response = new Response($jsonContent, Response::HTTP_OK);

        // $response->headers->set('Content-Type', 'application/json');
        // Allow all websites
        // $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
     
    }
    
   /**
     * One Place.
     * @FOSRest\Get("/api/places/{id}")
     *
     * 
     */
    public function getPlace(Request $request, Place $place) 
    {
        $serializer = SerializerBuilder::create()->build();
        $jsonContent = $serializer->serialize($place, 'json', SerializationContext::create()->setGroups(array('place_detail', 'place_list')));
        $response = new Response($jsonContent, Response::HTTP_OK);

        // $response->headers->set('Content-Type', 'application/json');
        // Allow all websites
        // $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }



   /**
     * CReate One Place.
     * @FOSRest\Post("/api/places/create")
     *
     * 
     */
    public function createPlace(Request $request, ObjectManager $em) 
    {
        $user = $this->getUser();

        if($user->getRole()->getCode() === 'ROLE_ARTIST'|| $user->getRole()->getCode() === 'ROLE_ORGANIZER') {
            
            $place = new Place();
            $image = trim(htmlspecialchars($request->get('image')));
            if(!empty(trim(htmlspecialchars($request->get('place_type'))))) {

                $repositoryPlaceType = $this->getDoctrine()->getRepository(PlaceType::class);
                $placeType = $repositoryPlaceType->findByPlaceTypeName(trim(htmlspecialchars($request->get('place_type'))));
                $place->setPlaceType($placeType[0]);
            }
            else {
                $place->setPlaceType(null);
            }

            if (empty($image)) {
                $place->setImage('PlaceDefault.jpg');

            } else {
                $place->setImage($image);
            }
            $place->setAppUserCreator($user);
            $place->setAdress(trim(htmlspecialchars($request->get('adress'))));
            $place->setCity(trim(htmlspecialchars($request->get('city'))));
            $place->setDescription(trim(htmlspecialchars($request->get('description'))));
            $place->setEmail(trim(htmlspecialchars($request->get('email'))));
            $place->setFacebook(trim(htmlspecialchars($request->get('facebook'))));
            $place->setName(trim(htmlspecialchars($request->get('name'))));
           
            // $place->setSiret(trim(htmlspecialchars($request->get('siret'))));
            $place->setWebsite(trim(htmlspecialchars($request->get('website'))));
            $place->setZipcode(trim(htmlspecialchars($request->get('zipcode'))));
            // $place->setImage(trim(htmlspecialchars($request->get('image'))));
            $em = $this->getDoctrine()->getManager();
            $em->persist($place);
            
            if (empty($place)){
                
                return new JsonResponse(['message' => 'Lieu non créé'], Response::HTTP_OK);
                
            }
            
            else {
                $em->flush();
            
                return new JsonResponse(['message' => 'Lieu créé'], Response::HTTP_OK);
            }
        }
        else {
            
            return new JsonResponse(['message' => 'Connecté vous en tant qu\'Artiste ou Organisateur'], Response::HTTP_OK);
        }
    }


    /**
    * @FOSRest\Put("/api/places/{id}/update")
    */
    public function updatePlace(Request $request, Place $place)
    {
        $user = $this->getUser();
        // dump($user);die;
        if ($user->getId() === $place->getAppUserCreator()->getId()) {
            if(empty($request->get('name'))) {
                $name = $place->getName();
            } else {
                $name = trim(htmlspecialchars($request->get('name')));
            }

            // if(empty($request->get('siret'))) {
            //     $siret = $place->getSiret();
            // } else {
            //     $siret = trim(htmlspecialchars($request->get('siret')));
            // }
        
            if(empty($request->get('adress'))) {
                $adress = $place->getAdress();
            } else {
                $adress = trim(htmlspecialchars($request->get('adress')));
            }

            if(empty($request->get('city'))) {
                $city = $place->getCity();
            } else {
                $city = trim(htmlspecialchars(strtoupper($request->get('city'))));
            }

            if(empty($request->get('zipcode'))) {
                $zipcode = $place->getZipcode();
            } else {
                $zipcode = trim(htmlspecialchars(($request->get('zipcode'))));
            }

            if(empty($request->get('email'))) {
                $email = $place->getEmail();
            } else {
                $email = trim(htmlspecialchars(($request->get('email'))));
            }

            if(empty($request->get('description'))) {
                $description = $place->getDescription();
            } else {
                $description = trim(htmlspecialchars(($request->get('description'))));
            }

            if(empty($request->get('website'))) {
                $website = $place->getWebsite();
            } else {
                $website = trim(htmlspecialchars(($request->get('website'))));
            }

            if(empty($request->get('image'))) {
                $image = $place->getImage();
            } else {
                $image = trim(htmlspecialchars(($request->get('image'))));
            }

            if(empty($request->get('facebook'))) {
                $facebook = $place->getFacebook();
            } else {
                $facebook = trim(htmlspecialchars(($request->get('facebook'))));
            }
         

            if(empty($request->get('place_type'))) {
                $placeType = $place->getPlaceType();
                $place->setPlaceType($placeType);
            } else {
                $repositoryPlaceType = $this->getDoctrine()->getRepository(PlaceType::class);
                $placeType = $repositoryPlaceType->findByPlaceTypeName($request->get('place_type'));
                $place->setPlaceType($placeType[0]);
                
            }     

            $place->setName($name);
            $place->setAdress($adress);
            $place->setCity($city);
            $place->setZipcode($zipcode);
            $place->setEmail($email);
            $place->setDescription($description);
            $place->setWebsite($website);
            $place->setImage($image);
            $place->setFacebook($facebook);

            $em = $this->getDoctrine()->getManager();
            $em->persist($place);
            $em->flush();
    
            return new JsonResponse(['message' => 'Lieu modifié !'], Response::HTTP_OK);
        }


        else {
            return new JsonResponse(['message' => 'Vous \'êtes pas autorisé à modifier ce lieu'], Response::HTTP_NOT_MODIFIED);
        }
    }

    /**
    * @FOSRest\Post("/api/places/{id}/comments")
    */
    public function postCommentPlace(Request $request, Place $place)
    {
        $user = $this->getUser();
        if (!$user) {
            return new JsonResponse(['message' => 'Non authentifié'], Response::HTTP_UNAUTHORIZED);
        }

        $data = json_decode($request->getContent(), true);
        $raw = is_array($data) ? ($data['content'] ?? $request->get('content')) : $request->get('content');
        $content = trim(htmlspecialchars((string) $raw));

        if (!empty($content)) {
        $comment = new Comment();
        $comment->setAppUser($user);
        $comment->setContent($content);
        $comment->setPlace($place);
            
        $em = $this->getDoctrine()->getManager();
        $em->persist($comment);
        $em->flush();
        return new JsonResponse(['message' => 'Commentaire  posté'], Response::HTTP_OK);

        } 
        else {

            return new JsonResponse(['message' => 'Commentaire vide'], Response::HTTP_OK);
        }
        
    }

  
    /**
     * Delete un lieu.
     * @FOSRest\Delete("/api/places/{id}/delete")
     *
     * 
     */
    public function deletePlace(Place $place) 
    {
        $user = $this->getUser();
        if ($user->getId() === $place->getAppUserCreator()->getId()) {
            if (empty($place)) {

                return new JsonResponse(['message' => 'Place not found'], Response::HTTP_NOT_FOUND);
            }
        
            $em = $this->getDoctrine()->getManager();
            $em->remove($place);
            $em->flush();
            return new JsonResponse(['message' => "Le lieu portant le nom : '".$place->getName()."' a été supprimé"], Response::HTTP_OK);
        }
        else {
            return new JsonResponse(['message' => "Vous n'êtes pas autorisé a supprimer ce lieu"], Response::HTTP_OK);
        }
    }
}
