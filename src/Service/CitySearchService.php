<?php

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class CitySearch
{
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
}