<?php

namespace App\Factory;

use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Zenstruck\Foundry\Persistence\PersistentObjectFactory;

/**
 * @extends PersistentObjectFactory<User>
 */
final class UserFactory extends PersistentObjectFactory
{
    private const DEFAULT_PASSWORD = 'P@ssw0rd';

    public function __construct(private UserPasswordHasherInterface $userPasswordHasher)
    {
    }

    #[\Override]    public static function class(): string
    {
        return User::class;
    }

        /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    #[\Override]
    protected function defaults(): array|callable
    {
        return [
            'email' => self::faker()->email(),
            'password' => $this->userPasswordHasher->hashPassword(new User(), self::DEFAULT_PASSWORD),
            'roles' => ["ROLE_USER"],
            'user_creation_date' => \DateTimeImmutable::createFromMutable(self::faker()->dateTime()),
            'user_lastname' => self::faker()->text(255),
            'user_name' => self::faker()->text(255),
        ];
    }

        /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    #[\Override]    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(User $user): void {})
        ;
    }
}
