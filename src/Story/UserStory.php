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
        // Create 5 regular users
        UserFactory::createMany(5);

        // Create 1 admin user
        UserFactory::createOne([
            'email' => 'admin@example.com',
            'roles' => ['ROLE_ADMIN', 'ROLE_USER'],
        ]);
    }
}
