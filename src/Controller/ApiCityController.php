<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

    /**
     * @Route("/api", name="api_")
     */
class ApiCityController extends AbstractController
{
    /**
     * @Route("/city/{slug}", name="get_city", methods={"GET"})
     */
    public function getCity(City $city)
    {
        return $this->json($city);
    }
}
