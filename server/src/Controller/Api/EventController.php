<?php

namespace App\Controller\Api;

use DateTime;
use App\Entity\Event;
use App\Entity\Place;
use App\Entity\AppUser;
use App\Entity\Comment;
use App\Entity\EventType;
use JMS\Serializer\SerializationContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\BaseController;


class EventController extends BaseController
{


    /**
     * Lists all Events.
     * @Route("/api/events", methods={"GET"})
     * 
     *
     * 
     */
    public function getEvents()
    {
        $repository = $this->getDoctrine()->getRepository(Event::class);
    
        $events = $repository->findEventsByCurrentDate();
        $serializer = $this->container->get('jms_serializer');
        $jsonContent = $serializer->serialize($events, 'json', SerializationContext::create()->setGroups(array('event_list')));
        $response = new Response($jsonContent, Response::HTTP_OK);

        return $response;
    }

    
    /**
     * One Events.
     * @Route("/api/events/{id}", methods={"GET"})
     *
     * 
     */
    public function getEvent(Request $request, Event $event)
    {
        $serializer = $this->container->get('jms_serializer');
        $jsonContent = $serializer->serialize($event, 'json', SerializationContext::create()->setGroups(array('event_list', 'event_detail')));
        $response = new Response($jsonContent, Response::HTTP_OK);

        return $response;
    }

    /**
     * One Events.
     * @Route("/api/events/{id}/participate", methods={"POST"})
     *
     * 
     */
    public function PostParticipateEvent(Request $request, Event $event)
    {
        $user = $this->getUser();
        if (!$user) {
            return new JsonResponse(['message' => 'Non authentifié'], Response::HTTP_UNAUTHORIZED);
        }

        $user->addEventsParticipant($event);
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->persist($event);
        $em->flush();
        return new JsonResponse(['message' => "Vous participez à l'événement " . $event->getName()], Response::HTTP_OK);
    }

    /**
     * Create Event.
     * @Route("/api/events/create", methods={"POST"})
     *
     * 
     */
    public function createEvent(Request $request)
    {
        
        $user = $this->getuser();
        if ($user->getRole()->getCode() === 'ROLE_ARTIST' || $user->getRole()->getCode() === 'ROLE_ORGANIZER') {
            
            $repositoryUser = $this->getDoctrine()->getRepository(AppUser::class);
            $artist = $repositoryUser->findByUsername('Bakers');
            $event = new Event();

            $repositoryPlace = $this->getDoctrine()->getRepository(Place::class);
            $place = $repositoryPlace->findByPlaceName(trim(htmlspecialchars($request->get('place_id'))));

            if (empty(trim(htmlspecialchars($request->get('event_type_id'))))) {
                $event->setEventType(null);
            }
            else {

                $repositoryEventType = $this->getDoctrine()->getRepository(EventType::class);
                $eventType = $repositoryEventType->findByEventTypeName(trim(htmlspecialchars($request->get('event_type_id'))));
                $event->setEventType($eventType[0]);
            }

            $nbSpectator = trim(htmlspecialchars($request->get('nb_spectator')));
            $price = trim(htmlspecialchars($request->get('price')));
            $image = trim(htmlspecialchars($request->get('image')));

            if (!empty($nbSpectator)) {
                
                $event->setNbSpectator($nbSpectator);
            }
            else {
                $event->setNbSpectator(null);
            }

            if (empty($image)) {
                $event->setImage('EventDefault.jpg');
               
            }
            else {
                $event->setImage($image);
            }

            if (!empty($price)) {
                
                $event->setPrice($price);
            }
            else {
                $event->setPrice(null);
            }
            $plannedDate = new DateTime($request->get('planned_date'));
            // $artiste = $repositoryUser->find($request->get('artist'));

            $event->setName(trim(htmlspecialchars($request->get('name'))));
            $event->setPlannedDate($plannedDate);
            $event->setDescription(trim(htmlspecialchars($request->get('description'))));
            // $event->setImage('EventDefault.jpg');

            $event->setAppUserCreator($user);
            if (!empty($artist)) {
                $event->addAppUserPerformer($artist[0]);
            }
            $event->setEventPlace($place[0]);
         

            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            if (empty($event)) {

                return new JsonResponse(['message' => 'Event non créé'], Response::HTTP_OK);

            } else {

                $em->flush();

                return new JsonResponse(['message' => "L'événément portant le nom : '" . $event->getName() . "' a été créé"], Response::HTTP_OK);
            }

        } else {
            return new JsonResponse(['message' => "Veuillez vous connecter en tant qu'Organisateur ou Artiste"], Response::HTTP_OK);
        }
    }


    /**
     * @Route("/api/events/{id}/update", methods={"PUT"})
     */
    public function updateEvent(Request $request, Event $event)
    {
        $user = $this->getUser();
        if ($user->getId() === $event->getAppUserCreator()->getId()) {

            if (empty($request->get('name'))) {
                $name = $event->getName();
            } else {
                $name = trim(htmlspecialchars($request->get('name')));
            }

            if (empty($request->get('planned_date'))) {
                $plannedDate = $event->getPlannedDate();
            } else {
                $plannedDate = new DateTime($request->get('planned_date'));
            }

            if (empty($request->get('nb_spectator'))) {
                $nbSpectator = $event->getNbSpectator();
            } else {
                $nbSpectator = trim(htmlspecialchars($request->get('nb_spectator')));
            }

            if (empty($request->get('price'))) {
                $price = $event->getPrice();
            } else {
                $price = trim(htmlspecialchars(strtoupper($request->get('price'))));
            }

            if (empty($request->get('description'))) {
                $description = $event->getDescription();
            } else {
                $description = trim(htmlspecialchars(($request->get('description'))));
            }

            if (empty($request->get('image'))) {
                $image = $event->getImage();
            } else {
                $image = trim(htmlspecialchars(($request->get('image'))));
            }

            if (empty($request->get('place_id'))) {
                $eventPlace = $event->getEventPlace();
                $event->setEventPlace($eventPlace);
            } else {
                $repositoryPlace = $this->getDoctrine()->getRepository(Place::class);
                $eventPlace = $repositoryPlace->findByPlaceName(trim(htmlspecialchars($request->get('place_id'))));
                $event->setEventPlace($eventPlace[0]);
            }

            if (empty($request->get('event_type_id'))) {
                $eventType = $event->getEventType();
                $event->setEventType($eventType);
            } else {
                $repositoryEventType = $this->getDoctrine()->getRepository(EventType::class);
                $eventType = $repositoryEventType->findByEventTypeName(trim(htmlspecialchars($request->get('event_type_id'))));
                $event->setEventType($eventType[0]);
            }

            $event->setName($name);
            $event->setPlannedDate($plannedDate);
            $event->setNbSpectator($nbSpectator);
            $event->setPrice($price);
            $event->setDescription($description);
            $event->setImage($image);

            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();

            return new JsonResponse(['message' => 'Événement modifié !'], Response::HTTP_OK);
        } 
        else {
            return new JsonResponse(['message' => 'Vous n\'êtes pas autorisé à modifier cet événement'], Response::HTTP_NOT_MODIFIED);
        }
    }

    /**
     * Delete un Event.
     * @Route("/api/events/{id}/delete", methods={"DELETE"})
     *
     * 
     */
    public function deleteEvent(Event $event)
    {
        $user = $this->getUser();
        if ($user->getId() === $event->getAppUserCreator()->getId()) {
            if (empty($event)) {

                return new JsonResponse(['message' => 'Event not found'], Response::HTTP_NOT_FOUND);
            }

            $em = $this->getDoctrine()->getManager();
            $em->remove($event);
            $em->flush();
            return new JsonResponse(['message' => "L'événément portant le nom : '" . $event->getName() . "' a été supprimé"], Response::HTTP_OK);
        } 
        else {
            return new JsonResponse(['message' => "Vous n'êtes pas autorisé a supprimer cette événement"], Response::HTTP_OK);
        }
    }

    /**
     * @Route("/api/events/{id}/comments", methods={"POST"})
     */
    public function postCommentEvent(Request $request, Event $event)
    {
        $user = $this->getUser();
        if (!$user) {
            return new JsonResponse(['message' => 'Non authentifié'], Response::HTTP_UNAUTHORIZED);
        }

        $content = $this->requestContent($request);

        if (!empty($content)) {

            $comment = new Comment();
            $comment->setAppUser($user);
            $comment->setContent($content);
            $comment->setEvent($event);
    
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();
    
            return new JsonResponse(['message' => 'Commentaire posté'], Response::HTTP_OK);
        }

       
        else {

            return new JsonResponse(['message' => 'Commentaire vide'], Response::HTTP_OK);
        }

    }

    /**
     * Read a JSON or form field from the request body.
     */
    private function requestContent(Request $request): string
    {
        $data = json_decode($request->getContent(), true);
        $content = is_array($data) ? ($data['content'] ?? $request->get('content')) : $request->get('content');

        return trim(htmlspecialchars((string) $content));
    }
}