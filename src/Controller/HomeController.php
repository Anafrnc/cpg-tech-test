<?php

namespace App\Controller;

use App\Service\CitySearchService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    public function searchBar(CitySearchService $citySearch, httpClientInterface $httpClient): Response
    {
        $showCity = $citySearch->getApiCity($httpClient);

        return $this->render('home/index.html.twig', [
            'cityNames' => $showCity,
        ]);
    }
}
