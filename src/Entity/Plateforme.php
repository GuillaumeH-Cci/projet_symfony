<?php

namespace App\Entity;

use App\Repository\PlateformeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlateformeRepository::class)]
class Plateforme
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $plat_name = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlatName(): ?string
    {
        return $this->plat_name;
    }

    public function setPlatName(string $plat_name): static
    {
        $this->plat_name = $plat_name;

        return $this;
    }
}
