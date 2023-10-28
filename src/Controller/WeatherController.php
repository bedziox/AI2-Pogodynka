<?php

namespace App\Controller;

use App\Entity\Location;
use App\Repository\WeatherRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WeatherController extends AbstractController
{
    #[Route('/weather/{city}', name: 'app_weather', requirements: ["city" => "[a-zA-Z]+"])]
    public function city(Location $location, WeatherRepository $repository): Response
    {
        $weather = $repository->findByLocation($location);
        return $this->render('weather/city.html.twig', [
            'location' => $location,
            'weather' => $weather,
        ]);
    }
}
