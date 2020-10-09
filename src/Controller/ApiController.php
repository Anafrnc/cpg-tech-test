<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ApiController extends AbstractController
{
    /**
     * @Route("/api", name="api")
     */
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
        return $this->render('home/index.html.twig', [
            'cityNames' => $cityNames->toArray(),
            'cityCodes' => $citycodes->toArray()
        ]);
    }

    /**
     * @Route("/api/show/{nom}", name="show")
     */
    public function ShowCity($nom, httpClientInterface $httpClient)
    {
        $cityName = $httpClient->request(
            'GET',
            'https://geo.api.gouv.fr/communes'.$nom
        );

        return $this->render('city/index.html.twig', [
            'cityName' => $cityName->toArray(),
        ]);
    }
}