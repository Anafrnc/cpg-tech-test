<?php

namespace App\Controller;

use App\Entity\City;
use App\Entity\Message;
use App\Form\MessageType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/city", name="city_")
 */
class CityController extends AbstractController
{
    /**
     * @Route("/{slug}", name="index")
     */
    public function index(
        City $city, Request $request,
        EntityManagerInterface $entityManager
    ): Response
    {
        $message = new Message();

        $messageForm = $this->createForm(MessageType::class, $message)
            ->remove('createdAt')
            ->remove('city')
            ->add('send', SubmitType::class)
            ;
        $messageForm->handleRequest($request);

        if($messageForm->isSubmitted() && $messageForm->isValid()) {
            $message->setCreatedAt(new \DateTime());
            $message->setCity($city);
            $entityManager->persist($message);
            $entityManager->flush();
        }
        return $this->render('city/index.html.twig', [
            'city' => $city,
            'messageForm' => $messageForm->createView(),
        ]);
    }
}
