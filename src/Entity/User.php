<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $user_lastname = null;

    #[ORM\Column(length: 255)]
    private ?string $user_name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $user_username = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $user_desc = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $user_profil_image = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $user_creation_date = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $user_modif_date = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $user_deleted_date = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Ensure the session doesn't contain actual password hashes by CRC32C-hashing them, as supported since Symfony 7.3.
     */
    public function __serialize(): array
    {
        $data = (array) $this;
        $data["\0" . self::class . "\0password"] = hash('crc32c', $this->password);
        
        return $data;
    }

    public function getUserLastname(): ?string
    {
        return $this->user_lastname;
    }

    public function setUserLastname(string $user_lastname): static
    {
        $this->user_lastname = $user_lastname;

        return $this;
    }

    public function getUserName(): ?string
    {
        return $this->user_name;
    }

    public function setUserName(string $user_name): static
    {
        $this->user_name = $user_name;

        return $this;
    }

    public function getUserUsername(): ?string
    {
        return $this->user_username;
    }

    public function setUserUsername(?string $user_username): static
    {
        $this->user_username = $user_username;

        return $this;
    }

    public function getUserDesc(): ?string
    {
        return $this->user_desc;
    }

    public function setUserDesc(?string $user_desc): static
    {
        $this->user_desc = $user_desc;

        return $this;
    }

    public function getUserProfilImage(): ?string
    {
        return $this->user_profil_image;
    }

    public function setUserProfilImage(?string $user_profil_image): static
    {
        $this->user_profil_image = $user_profil_image;

        return $this;
    }

    public function getUserCreationDate(): ?\DateTimeImmutable
    {
        return $this->user_creation_date;
    }

    public function setUserCreationDate(\DateTimeImmutable $user_creation_date): static
    {
        $this->user_creation_date = $user_creation_date;

        return $this;
    }

    public function getUserModifDate(): ?\DateTimeImmutable
    {
        return $this->user_modif_date;
    }

    public function setUserModifDate(?\DateTimeImmutable $user_modif_date): static
    {
        $this->user_modif_date = $user_modif_date;

        return $this;
    }

    public function getUserDeletedDate(): ?\DateTimeImmutable
    {
        return $this->user_deleted_date;
    }

    public function setUserDeletedDate(?\DateTimeImmutable $user_deleted_date): static
    {
        $this->user_deleted_date = $user_deleted_date;

        return $this;
    }
}
