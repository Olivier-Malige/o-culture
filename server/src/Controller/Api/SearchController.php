<?php

namespace App\Controller\Api;

use App\Entity\Event;
use App\Entity\Place;
use App\Entity\AppUser;
// use FOS\RestBundle\View\View;
use App\Repository\EventRepository;
use App\Repository\PlaceRepository;
use App\Repository\AppUserRepository;
use JMS\Serializer\SerializationContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\BaseController;

class SearchController extends BaseController
{
    /**
     * @Route("/api/events/search", methods={"POST"})
     */

    public function searchEventByName(Request $request)
    {
        $serializer = $this->container->get('jms_serializer');
        $eventRepository = $this->getDoctrine()->getRepository(Event::class);
        $events = $eventRepository->findByName(trim(htmlspecialchars($request->get('search'))));              
                
        if(empty($events)) {
            
            $jsonContent = $serializer->serialize(['status' => false, 'error' => 0, 'message' => 'Aucun élément ne correspond à la recherche'], 'json');
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
     * @Route("/api/search/events/{search}", methods={"GET"})
     */

    public function searchEventName($search)
    {
        $serializer = $this->container->get('jms_serializer');
        $eventRepository = $this->getDoctrine()->getRepository(Event::class);
        $events = $eventRepository->findByName(trim(htmlspecialchars($search)));              

        if(empty($events)) {
            
            $jsonContent = $serializer->serialize(['status' => false, 'error' => 0, 'message' => 'Aucun élément ne correspond à la recherche'], 'json');
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
     * @Route("/api/artists/search", methods={"POST"})
     */

    public function searchArtistByName(Request $request) 
    {
        $serializer = $this->container->get('jms_serializer');
        $appUserRepository = $this->getDoctrine()->getRepository(AppUser::class);
        $artists = $appUserRepository->findByName(trim(htmlspecialchars($request->get('search'))));              
                
        if(empty($artists)) {
            
            $jsonContent = $serializer->serialize(['status' => false, 'error' => 0, 'message' => 'Aucun élément ne correspond à la recherche'], 'json');
            $response = new Response($jsonContent, Response::HTTP_OK);
            return $response;
        }
        
        else {
            
            $jsonContent = $serializer->serialize($artists, 'json', SerializationContext::create()->setGroups(array('appuser_list', 'appuser_a_detail')));
            $response = new Response($jsonContent, Response::HTTP_OK);
            return $response;
        }  
    }

    /**
     * @Route("/api/search/artists/{search}", methods={"GET"})
     */

    public function searchArtistName($search) 
    {
        $serializer = $this->container->get('jms_serializer');
        $appUserRepository = $this->getDoctrine()->getRepository(AppUser::class);
        $artists = $appUserRepository->findByName(trim(htmlspecialchars($search)));              
                
        if(empty($artists)) {
            
            $jsonContent = $serializer->serialize(['status' => false, 'error' => 0, 'message' => 'Aucun élément ne correspond à la recherche'], 'json');
            $response = new Response($jsonContent, Response::HTTP_OK);
            return $response;
        }
        
        else {
            
            $jsonContent = $serializer->serialize($artists, 'json', SerializationContext::create()->setGroups(array('appuser_list', 'appuser_a_detail')));
            $response = new Response($jsonContent, Response::HTTP_OK);
            return $response;
        }  
        
    }

    /**
     * @Route("/api/places/search", methods={"POST"})
     */

    public function searchPlaceByName(Request $request) 
    {
        $serializer = $this->container->get('jms_serializer');
        $placeRepository = $this->getDoctrine()->getRepository(Place::class);
        $places = $placeRepository->findByName(trim(htmlspecialchars($request->get('search'))));              
                
        if(empty($places)) {
            
            $jsonContent = $serializer->serialize(['status' => false, 'error' => 0, 'message' => 'Aucun élément ne correspond à la recherche'], 'json');
            $response = new Response($jsonContent, Response::HTTP_OK);
            return $response;
        }
        
        else {
            
            $jsonContent = $serializer->serialize($places, 'json', SerializationContext::create()->setGroups(array('place_list', 'place_detail')));
            $response = new Response($jsonContent, Response::HTTP_OK);
            return $response;
        }  
        
    }

    /**
     * @Route("/api/search/places/{search}", methods={"GET"})
     */

    public function searchPlaceName($search) 
    {
        $serializer = $this->container->get('jms_serializer');
        $placeRepository = $this->getDoctrine()->getRepository(Place::class);
        $places = $placeRepository->findByName(trim(htmlspecialchars($search)));              
                
        if(empty($places)) {
            
            $jsonContent = $serializer->serialize(['status' => false, 'error' => 0, 'message' => 'Aucun élément ne correspond à la recherche'], 'json');
            $response = new Response($jsonContent, Response::HTTP_OK);
            return $response;
        }
        
        else {
            
            $jsonContent = $serializer->serialize($places, 'json', SerializationContext::create()->setGroups(array('place_list', 'place_detail')));
            $response = new Response($jsonContent, Response::HTTP_OK);
            return $response;
        }  
        
    }

    /**
     * List Events by Type.
     * @Route("/api/type/{type}/events", methods={"GET"})
     *
     * 
     */
    public function getEventsByType($type)
    {
        $repository = $this->getDoctrine()->getRepository(Event::class);
        $serializer = $this->container->get('jms_serializer');

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
     * @Route("/api/events/date/{date}", methods={"GET"})
     *
     * 
     */
    public function getEventsByDate($date)
    {
        $repository = $this->getDoctrine()->getRepository(Event::class);
        $serializer = $this->container->get('jms_serializer');
        
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
     * @Route("/api/city/{city}/events", methods={"GET"})
     *
     * 
     */
    public function getEventsByPlaceCity($city)
    {
        $repository = $this->getDoctrine()->getRepository(Event::class);
        $serializer = $this->container->get('jms_serializer');
        
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
     * @Route("/api/zipcode/{zipcode}/events", methods={"GET"})
     *
     * 
     */
    public function getEventsByDepartment($zipcode)
    {
        $repository = $this->getDoctrine()->getRepository(Event::class);
        $serializer = $this->container->get('jms_serializer');
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
     * @Route("/api/artists/{artist}/events", methods={"GET"})
     * 
     */
    public function getEventsByArtist($artist)
    {
        $repository = $this->getDoctrine()->getRepository(Event::class);
        $serializer = $this->container->get('jms_serializer');
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
