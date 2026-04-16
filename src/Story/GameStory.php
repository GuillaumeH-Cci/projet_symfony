<?php

namespace App\Story;

use App\Factory\ArticleFactory;
use Zenstruck\Foundry\Story;


/**
 * Story permettant de créer des données d'exemple pour les jeux vidéo.
 */
final class GameStory extends Story
{
    public function build(): void
    {
        // Load dependencies
        UserStory::load();
        CatStory::load();
        PlatStory::load();

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
