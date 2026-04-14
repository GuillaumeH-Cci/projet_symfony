<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $article_name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $article_desc = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $article_thumbnail = null;

    #[ORM\Column(type: Types::INTEGER)]
    private ?int $article_nbr_player = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $article_creation_date = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $article_modif_date = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $article_deleted_date = null;

    #[ORM\ManyToOne]
    private ?User $usr = null;

    #[ORM\ManyToOne]
    private ?Categories $cat = null;

    /**
     * @var Collection<int, Plateforme>
     */
    #[ORM\ManyToMany(targetEntity: Plateforme::class)]
    private Collection $plat;

    public function __construct()
    {
        $this->plat = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArticleName(): ?string
    {
        return $this->article_name;
    }

    public function setArticleName(string $article_name): static
    {
        $this->article_name = $article_name;

        return $this;
    }

    public function getArticleDesc(): ?string
    {
        return $this->article_desc;
    }

    public function setArticleDesc(string $article_desc): static
    {
        $this->article_desc = $article_desc;

        return $this;
    }

    public function getArticleThumbnail(): ?string
    {
        return $this->article_thumbnail;
    }

    public function setArticleThumbnail(?string $article_thumbnail): static
    {
        $this->article_thumbnail = $article_thumbnail;

        return $this;
    }

    public function getArticleNbrPlayer(): ?int
    {
        return $this->article_nbr_player;
    }

    public function setArticleNbrPlayer(int $article_nbr_player): static
    {
        $this->article_nbr_player = $article_nbr_player;

        return $this;
    }

    public function getArticleCreationDate(): ?\DateTimeImmutable
    {
        return $this->article_creation_date;
    }

    public function setArticleCreationDate(\DateTimeImmutable $article_creation_date): static
    {
        $this->article_creation_date = $article_creation_date;

        return $this;
    }

    public function getArticleModifDate(): ?\DateTimeImmutable
    {
        return $this->article_modif_date;
    }

    public function setArticleModifDate(?\DateTimeImmutable $article_modif_date): static
    {
        $this->article_modif_date = $article_modif_date;

        return $this;
    }

    public function getArticleDeletedDate(): ?\DateTimeImmutable
    {
        return $this->article_deleted_date;
    }

    public function setArticleDeletedDate(?\DateTimeImmutable $article_deleted_date): static
    {
        $this->article_deleted_date = $article_deleted_date;

        return $this;
    }

    public function getUsr(): ?User
    {
        return $this->usr;
    }

    public function setUsr(?User $usr): static
    {
        $this->usr = $usr;

        return $this;
    }

    public function getCat(): ?Categories
    {
        return $this->cat;
    }

    public function setCat(?Categories $cat): static
    {
        $this->cat = $cat;

        return $this;
    }

    /**
     * @return Collection<int, Plateforme>
     */
    public function getPlat(): Collection
    {
        return $this->plat;
    }

    public function addPlat(Plateforme $plat): static
    {
        if (!$this->plat->contains($plat)) {
            $this->plat->add($plat);
        }

        return $this;
    }

    public function removePlat(Plateforme $plat): static
    {
        $this->plat->removeElement($plat);

        return $this;
    }
}
