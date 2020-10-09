<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class CitySearchService
{
    private $client;

    public function fetchCity(httpClientInterface $httpClient)
    {
        $response = $this->client->request(
            'GET',
            'https://geo.api.gouv.fr/communes/{code}'
        );
        if($response->getStatusCode() === Response::HTTP_FOUND) {
            throw new NotFoundHttpException('Cette ville n\'existe pas');
        }
        return $this->render('city/index.html.twig', [
            'cityName' => $response->toArray(),
        ]);
    }

    public function getApiCity(httpClientInterface $httpClient)
    {
        $cityNames = $httpClient->request(
            'GET',
            'https://geo.api.gouv.fr/communes?nom='
        );
        $citycodes = $httpClient->request(
            'GET',
            'https://geo.api.gouv.fr/communes?codePostal='
        );
        return  [
            'cityNames' => $cityNames->toArray(),
            'cityCodes' => $citycodes->toArray()
        ];
    }
}