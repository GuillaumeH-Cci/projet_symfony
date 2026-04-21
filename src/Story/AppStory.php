<?php

namespace App\Story;

use App\Factory\ArticleFactory;
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
    // Créer 10 articles avec des utilisateurs, catégories et plateformes aléatoires
    $games = ArticleFactory::createMany(10, function () {
        return [
            'usr' => UserStory::getRandom('users'),
            'cat' => CatStory::getRandom('categories'),
            'plat' => PlatStory::getRandomRange('plateformes', 1, 3),
        ];
    });

    $this->addState('games', $games, 'games');
    }    
}
