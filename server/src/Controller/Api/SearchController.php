<?php

namespace App\Controller\Api;

use App\Entity\Event;
use App\Entity\Place;
use App\Entity\AppUser;
// use FOS\RestBundle\View\View;
use App\Repository\EventRepository;
use App\Repository\PlaceRepository;
use App\Repository\AppUserRepository;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializationContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\Controller\Annotations as FOSRest;

class SearchController extends FOSRestController
{
    /**
     * @FOSRest\POST("/api/events/search")
     */

    public function searchEventByName(Request $request)
    {
        $serializer = SerializerBuilder::create()->build();
        $eventRepository = $this->getDoctrine()->getRepository(Event::class);
        $events = $eventRepository->findByName(trim(htmlspecialchars($request->get('search'))));              
                
        if(empty($events)) {
            
            $jsonContent = $serializer->serialize(['status' => false, 'error' => 0, 'message' => 'Aucun élément ne correspond à la recherche'], 'json');
            $response = new Response($jsonContent, Response::HTTP_OK);
            return $response;
        }
        
        else {       
            
            $jsonContent = $serializer->serialize($events, 'json');            
            $response = new Response($jsonContent, Response::HTTP_OK);
            return $response;
        }        
    }

    /**
     * @FOSRest\GET("/api/search/events/{search}")
     */

    public function searchEventName($search)
    {
        $serializer = SerializerBuilder::create()->build();
        $eventRepository = $this->getDoctrine()->getRepository(Event::class);
        $events = $eventRepository->findByName(trim(htmlspecialchars($search)));              

        if(empty($events)) {
            
            $jsonContent = $serializer->serialize(['status' => false, 'error' => 0, 'message' => 'Aucun élément ne correspond à la recherche'], 'json');
            $response = new Response($jsonContent, Response::HTTP_OK);
            return $response;
        }
        
        else {       
            
            $jsonContent = $serializer->serialize($events, 'json');            
            $response = new Response($jsonContent, Response::HTTP_OK);
            return $response;
        }        
    }
    
    /**
     * @FOSRest\POST("/api/artists/search")
     */

    public function searchArtistByName(Request $request) 
    {
        $serializer = SerializerBuilder::create()->build();
        $appUserRepository = $this->getDoctrine()->getRepository(AppUser::class);
        $artists = $appUserRepository->findByName(trim(htmlspecialchars($request->get('search'))));              
                
        if(empty($artists)) {
            
            $jsonContent = $serializer->serialize(['status' => false, 'error' => 0, 'message' => 'Aucun élément ne correspond à la recherche'], 'json');
            $response = new Response($jsonContent, Response::HTTP_OK);
            return $response;
        }
        
        else {
            
            $jsonContent = $serializer->serialize($artists, 'json');            
            $response = new Response($jsonContent, Response::HTTP_OK);
            return $response;
        }  
    }

    /**
     * @FOSRest\GET("/api/search/artists/{search}")
     */

    public function searchArtistName($search) 
    {
        $serializer = SerializerBuilder::create()->build();
        $appUserRepository = $this->getDoctrine()->getRepository(AppUser::class);
        $artists = $appUserRepository->findByName(trim(htmlspecialchars($search)));              
                
        if(empty($artists)) {
            
            $jsonContent = $serializer->serialize(['status' => false, 'error' => 0, 'message' => 'Aucun élément ne correspond à la recherche'], 'json');
            $response = new Response($jsonContent, Response::HTTP_OK);
            return $response;
        }
        
        else {
            
            $jsonContent = $serializer->serialize($artists, 'json');            
            $response = new Response($jsonContent, Response::HTTP_OK);
            return $response;
        }  
        
    }

    /**
     * @FOSRest\POST("/api/places/search")
     */

    public function searchPlaceByName(Request $request) 
    {
        $serializer = SerializerBuilder::create()->build();
        $placeRepository = $this->getDoctrine()->getRepository(Place::class);
        $places = $placeRepository->findByName(trim(htmlspecialchars($request->get('search'))));              
                
        if(empty($places)) {
            
            $jsonContent = $serializer->serialize(['status' => false, 'error' => 0, 'message' => 'Aucun élément ne correspond à la recherche'], 'json');
            $response = new Response($jsonContent, Response::HTTP_OK);
            return $response;
        }
        
        else {
            
            $jsonContent = $serializer->serialize($places, 'json');            
            $response = new Response($jsonContent, Response::HTTP_OK);
            return $response;
        }  
        
    }

    /**
     * @FOSRest\GET("/api/search/places/{search}")
     */

    public function searchPlaceName($search) 
    {
        $serializer = SerializerBuilder::create()->build();
        $placeRepository = $this->getDoctrine()->getRepository(Place::class);
        $places = $placeRepository->findByName(trim(htmlspecialchars($search)));              
                
        if(empty($places)) {
            
            $jsonContent = $serializer->serialize(['status' => false, 'error' => 0, 'message' => 'Aucun élément ne correspond à la recherche'], 'json');
            $response = new Response($jsonContent, Response::HTTP_OK);
            return $response;
        }
        
        else {
            
            $jsonContent = $serializer->serialize($places, 'json');            
            $response = new Response($jsonContent, Response::HTTP_OK);
            return $response;
        }  
        
    }

    /**
     * List Events by Type.
     * @FOSRest\Get("/api/type/{type}/events")
     *
     * 
     */
    public function getEventsByType($type)
    {
        $repository = $this->getDoctrine()->getRepository(Event::class);
        $serializer = SerializerBuilder::create()->build();

        $events = $repository->findByType(trim(htmlspecialchars($type)));

        if (empty($events)) {

            $jsonContent = $serializer->serialize(['status' => false, 'error' => 0, 'message' => 'Aucun événement disponible'], 'json');
            $response = new Response($jsonContent, Response::HTTP_OK);
            return $response;
        } else {
     
            $jsonContent = $serializer->serialize($events, 'json', SerializationContext::create()->setGroups(array('event_list')));
            $response = new Response($jsonContent, Response::HTTP_OK);
            return $response;
        }  
    }

    /**
     * List Events by Date.
     * @FOSRest\Get("/api/events/date/{date}")
     *
     * 
     */
    public function getEventsByDate($date)
    {
        $repository = $this->getDoctrine()->getRepository(Event::class);
        $serializer = SerializerBuilder::create()->build();
        
        $events = $repository->findByDate(trim(htmlspecialchars($date)));

        if (empty($events)) {

            $jsonContent = $serializer->serialize(['status' => false, 'error' => 0, 'message' => 'Aucun événement disponible'], 'json');
            $response = new Response($jsonContent, Response::HTTP_OK);
            return $response;
        } else {
     
            $jsonContent = $serializer->serialize($events, 'json', SerializationContext::create()->setGroups(array('event_list')));
            $response = new Response($jsonContent, Response::HTTP_OK);
            return $response;
        }  
    }

    /**
     * List Events by City.
     * @FOSRest\Get("/api/city/{city}/events")
     *
     * 
     */
    public function getEventsByPlaceCity($city)
    {
        $repository = $this->getDoctrine()->getRepository(Event::class);
        $serializer = SerializerBuilder::create()->build();
        
        $events = $repository->findByCity(trim(htmlspecialchars($city)));
        // dump($events);die;
        if (empty($events)) {

            $jsonContent = $serializer->serialize(['status' => false, 'error' => 0, 'message' => 'Aucun événement disponible'], 'json');
            $response = new Response($jsonContent, Response::HTTP_OK);
            return $response;
        } 
        else {
     
            $jsonContent = $serializer->serialize($events, 'json', SerializationContext::create()->setGroups(array('event_list')));
            $response = new Response($jsonContent, Response::HTTP_OK);
            return $response;
        }  
    }

    /**
     * List Events by Zipcode.
     * @FOSRest\Get("/api/zipcode/{zipcode}/events")
     *
     * 
     */
    public function getEventsByDepartment($zipcode)
    {
        $repository = $this->getDoctrine()->getRepository(Event::class);
        $serializer = SerializerBuilder::create()->build();
        // dump($zipcode);
        $events = $repository->findByZipCode(trim(htmlspecialchars($zipcode)));
        // dump($events);die;
        if (empty($events)) {

            $jsonContent = $serializer->serialize(['status' => false, 'error' => 0, 'message' => 'Aucun événement disponible'], 'json');
            $response = new Response($jsonContent, Response::HTTP_OK);
            return $response;
        } else {

            $jsonContent = $serializer->serialize($events, 'json', SerializationContext::create()->setGroups(array('event_list','event_detail')));
            $response = new Response($jsonContent, Response::HTTP_OK);
            return $response;
        }  
    }

    /**
     * List Events by Artists.
     * @FOSRest\Get("/api/artists/{artist}/events")
     * 
     */
    public function getEventsByArtist($artist)
    {
        $repository = $this->getDoctrine()->getRepository(Event::class);
        $serializer = SerializerBuilder::create()->build();
        // dump($artist);die;
        $events = $repository->findByArtist(trim(htmlspecialchars($artist)));
        // dump($events);die;
        if (empty($events)) {
            $jsonContent = $serializer->serialize(['status' => false, 'error' => 0, 'message' => 'Aucun événement disponible'], 'json');
            $response = new Response($jsonContent, Response::HTTP_OK);
            return $response;
        } else {

            $jsonContent = $serializer->serialize($events, 'json', SerializationContext::create()->setGroups(array('event_list','event_detail')));
            $response = new Response($jsonContent, Response::HTTP_OK);
            return $response;
        }  
    }
}
