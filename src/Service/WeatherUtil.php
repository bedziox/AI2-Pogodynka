<?php
declare(strict_types=1);

namespace App\Service;

use App\Entity\Location;
use App\Entity\Weather;
use App\Repository\LocationRepository;
use App\Repository\WeatherRepository;
use phpDocumentor\Reflection\Types\This;

class WeatherUtil
{
    /**
     * @return Weather[]
     */
    public function __construct(
        private readonly LocationRepository    $locationRepository,
        private readonly WeatherRepository $weatherRepository,
    )
    {
    }
    public function getWeatherForLocation(Location $location): array
    {
        return $this->weatherRepository->findByLocation($location);
    }

    /**
     * @return Weather[]
     */
    public function getWeatherForCountryAndCity(string $countryCode, string $city): array
    {
        $location = $this->locationRepository->findOneBy([
            'country' => $countryCode,
            'city' => $city,
        ]);

        return $this->getWeatherForLocation($location);
    }
}
