<?php

namespace App\Controller\Api;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\BaseController;

class GeocodeController extends BaseController
{
    /**
     * Resolve an address to coordinates via Nominatim, with Open-Meteo as fallback.
     *
     * @Route("/api/geocode", methods={"GET"})
     */
    public function geocode(Request $request): JsonResponse
    {
        $query = trim((string) $request->query->get('q', ''));
        $fallback = trim((string) $request->query->get('fallback', ''));
        $city = trim((string) $request->query->get('city', ''));
        $cityQuery = $city !== '' ? $city.' France' : '';
        $hit = null;
        foreach (array_unique(array_filter([$query, $fallback, $cityQuery])) as $candidate) {
            $hit = $this->lookupNominatim($candidate);
            if ($hit !== null) {
                break;
            }
        }
        if ($hit === null) {
            $hit = $this->lookupOpenMeteo($city);
        }
        if ($hit === null) {
            return new JsonResponse(['lat' => null, 'lon' => null]);
        }

        return new JsonResponse($hit);
    }

    /**
     * Query Nominatim and return lat/lon, or null.
     */
    private function lookupNominatim(string $query): ?array
    {
        if ($query === '') {
            return null;
        }

        $url = 'https://nominatim.openstreetmap.org/search?'.http_build_query([
            'format' => 'json',
            'limit' => 1,
            'countrycodes' => 'fr',
            'q' => $query,
        ]);
        $raw = $this->fetchUrl($url, "User-Agent: OCulture/1.0 (demo)\r\nAccept: application/json\r\n");
        $hits = json_decode((string) $raw, true);
        if (!is_array($hits) || empty($hits[0]['lat']) || empty($hits[0]['lon'])) {
            return null;
        }

        return ['lat' => (float) $hits[0]['lat'], 'lon' => (float) $hits[0]['lon']];
    }

    /**
     * Query Open-Meteo geocoding (city-level) and return lat/lon, or null.
     */
    private function lookupOpenMeteo(string $query): ?array
    {
        if ($query === '') {
            return null;
        }

        $url = 'https://geocoding-api.open-meteo.com/v1/search?'.http_build_query([
            'name' => $query,
            'count' => 1,
            'language' => 'fr',
            'format' => 'json',
            'countryCode' => 'FR',
        ]);
        $raw = $this->fetchUrl($url, "Accept: application/json\r\n");
        $data = json_decode((string) $raw, true);
        if (empty($data['results'][0]['latitude']) || empty($data['results'][0]['longitude'])) {
            return null;
        }

        return [
            'lat' => (float) $data['results'][0]['latitude'],
            'lon' => (float) $data['results'][0]['longitude'],
        ];
    }

    /**
     * Fetch a URL body, or null on failure.
     */
    private function fetchUrl(string $url, string $headers): ?string
    {
        $context = stream_context_create([
            'http' => [
                'method' => 'GET',
                'header' => $headers,
                'timeout' => 5,
                'ignore_errors' => true,
            ],
        ]);
        $raw = @file_get_contents($url, false, $context);

        return $raw === false ? null : $raw;
    }
}
