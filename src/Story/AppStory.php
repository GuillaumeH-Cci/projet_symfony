<?php

namespace App\Story;

use Zenstruck\Foundry\Attribute\AsFixture;
use Zenstruck\Foundry\Story;

/**
 * Story principale qui regroupe toutes les autres stories pour créer un ensemble de données d'exemple cohérent.
 */
#[AsFixture(name: 'main')]
final class AppStory extends Story
{
    public function build(): void
    {
        $this->addDependency(UserStory::class);
        $this->addDependency(CatStory::class);
        $this->addDependency(PlatStory::class);
        $this->addDependency(GameStory::class);
    }
}
