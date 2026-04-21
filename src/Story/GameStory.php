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
    // Articles spécifiques
    ArticleFactory::createOne([
        'article_name' => 'The Legend of Zelda: Ocarina of Time',
        'article_desc' => 'Un jeu d\'aventure emblématique sur Nintendo 64.',
        'article_nbr_player' => 1,
        'article_creation_date' => new \DateTimeImmutable('1998-11-21'),
        'usr' => UserStory::get('users'),
        'cat' => CatStory::getRandom('categories'),
        'plat' => PlatStory::getRandomRange('plateformes', 1, 2),
    ]);

    ArticleFactory::createOne([
        'article_name' => 'Super Mario 64',
        'article_desc' => 'Le premier Mario en 3D, révolutionnaire.',
        'article_nbr_player' => 1,
        'article_creation_date' => new \DateTimeImmutable('1996-06-23'),
        'usr' => UserStory::get('users'),
        'cat' => CatStory::getRandom('categories'),
        'plat' => PlatStory::getRandomRange('plateformes', 1, 1),
    ]);

    // Articles aléatoires pour remplir
    $games = ArticleFactory::createMany(10, function () {
        return [
            'usr' => UserStory::getRandom('users'),
            'cat' => CatStory::getRandom('categories'),
            'plat' => PlatStory::getRandomRange('plateformes', 1, 3),
        ];
    });

    $this->addToPool('games', $games);
    }
}
