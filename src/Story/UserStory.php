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
        $users = UserFactory::createMany(5);
        $this->addState('users', $users, 'users');

        // Create 1 admin user
        $admin = UserFactory::createOne([
            'email' => 'admin@example.com',
            'roles' => ['ROLE_ADMIN', 'ROLE_USER'],
        ]);
        $this->addState('admin', $admin);
    }
}
