<?php

namespace App\Story;

use App\Factory\UserFactory;
use Zenstruck\Foundry\Story;

/**
 * Story permettant de créer des utilisateurs d'exemple pour les jeux vidéo.
 */
final class UserStory extends Story
{
    public function build(): void
    {
        UserFactory::createOne([
            'email' => 'guillaumehess411@gmail.com',
            'user_username' => 'Guillaume',
            'roles' => ['ROLE_ADMIN', 'ROLE_USER'],
        ]);

        UserFactory::createOne([
            'email' => 'alice@example.com',
            'user_username' => 'Alice',
            'user_name' => 'Alice',
            'user_lastname' => 'Dupont',
        ]);

        UserFactory::createOne([
            'email' => 'bob@example.com',
            'user_username' => 'Bob',
            'user_name' => 'Bob',
            'user_lastname' => 'Martin',
        ]);

        UserFactory::createOne([
            'email' => 'fanta@example.com',
            'user_username' => 'Fanta',
            'user_name' => 'Fanta',
            'user_lastname' => 'Martin',
        ]);

        UserFactory::createOne([
            'email' => 'Jean@example.com',
            'user_username' => 'Jean',
            'user_name' => 'Jean',
            'user_lastname' => 'Peuplu',
        ]);
    }
}
