<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
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
}
