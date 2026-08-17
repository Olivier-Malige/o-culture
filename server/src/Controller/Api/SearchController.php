<?php

namespace App\Controller\Api;

use App\Entity\Event;
use App\Entity\Place;
use App\Entity\AppUser;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\BaseController;

class SearchController extends BaseController
{
    /**
     * @Route("/api/events/search", methods={"POST"})
     */
    public function searchEventByName(Request $request): Response
    {
        $events = $this->getDoctrine()->getRepository(Event::class)->findByName($this->searchTerm($request));

        return $this->serializeList($events, ['event_list'], 'Aucun élément ne correspond à la recherche');
    }

    /**
     * @Route("/api/artists/search", methods={"POST"})
     */
    public function searchArtistByName(Request $request): Response
    {
        $artists = $this->getDoctrine()->getRepository(AppUser::class)->findByName($this->searchTerm($request));

        return $this->serializeList($artists, ['appuser_list', 'appuser_a_detail'], 'Aucun élément ne correspond à la recherche');
    }

    /**
     * @Route("/api/places/search", methods={"POST"})
     */
    public function searchPlaceByName(Request $request): Response
    {
        $places = $this->getDoctrine()->getRepository(Place::class)->findByName($this->searchTerm($request));

        return $this->serializeList($places, ['place_list', 'place_detail'], 'Aucun élément ne correspond à la recherche');
    }

    /**
     * @Route("/api/type/{type}/events", methods={"GET"})
     */
    public function getEventsByType(string $type): Response
    {
        $events = $this->getDoctrine()->getRepository(Event::class)->findByType(trim(htmlspecialchars($type)));

        return $this->serializeList($events, ['event_list'], 'Aucun événement disponible');
    }

    /**
     * @Route("/api/events/date/{date}", methods={"GET"})
     */
    public function getEventsByDate(string $date): Response
    {
        $events = $this->getDoctrine()->getRepository(Event::class)->findByDate(trim(htmlspecialchars($date)));

        return $this->serializeList($events, ['event_list'], 'Aucun événement disponible');
    }

    /**
     * @Route("/api/zipcode/{zipcode}/events", methods={"GET"})
     */
    public function getEventsByDepartment(string $zipcode): Response
    {
        $events = $this->getDoctrine()->getRepository(Event::class)->findByZipCode(trim(htmlspecialchars($zipcode)));

        return $this->serializeList($events, ['event_list', 'event_detail'], 'Aucun événement disponible');
    }

    /**
     * @Route("/api/artists/{artist}/events", methods={"GET"})
     */
    public function getEventsByArtist(string $artist): Response
    {
        $events = $this->getDoctrine()->getRepository(Event::class)->findByArtist(trim(htmlspecialchars($artist)));

        return $this->serializeList($events, ['event_list', 'event_detail'], 'Aucun événement disponible');
    }

    /**
     * Read and sanitize the JSON/form search field.
     */
    private function searchTerm(Request $request): string
    {
        return trim(htmlspecialchars((string) $request->get('search', '')));
    }
}
