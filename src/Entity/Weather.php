<?php

namespace App\Entity;

use App\Repository\WeatherRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WeatherRepository::class)]
class Weather
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'weather')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Location $location = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 3, scale: '0')]
    private ?string $celsius = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $windSpeed = null;

    #[ORM\Column(nullable: true)]
    private ?int $precipitation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLocation(): ?Location
    {
        return $this->location;
    }

    public function setLocation(?Location $location): static
    {
        $this->location = $location;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getCelsius(): ?string
    {
        return $this->celsius;
    }

    public function setCelsius(string $celsius): static
    {
        $this->celsius = $celsius;

        return $this;
    }

    public function getWindSpeed(): ?string
    {
        return $this->windSpeed;
    }

    public function setWindSpeed(?string $windSpeed): static
    {
        $this->windSpeed = $windSpeed;

        return $this;
    }

    public function getPrecipitation(): ?int
    {
        return $this->precipitation;
    }

    public function setPrecipitation(?int $precipitation): static
    {
        $this->precipitation = $precipitation;

        return $this;
    }
}
