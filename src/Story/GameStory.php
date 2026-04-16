<?php

namespace App\Story;

use App\Factory\ArticleFactory;
use App\Factory\UserFactory;
use App\Factory\CategoriesFactory;
use App\Factory\PlateformeFactory;
use Zenstruck\Foundry\Story;


/**
 * Story permettant de créer des données d'exemple pour les jeux vidéo.
 */
final class GameStory extends Story
{
    public function build(): void
    {
        $this->addDependency(UserStory::class);
        $this->addDependency(CatStory::class);
        $this->addDependency(PlatStory::class);

        // Créer 10 articles avec des utilisateurs, catégories et plateformes aléatoires
        ArticleFactory::createMany(10, function () {
            return [
                'usr' => UserFactory::random(),
                'cat' => CategoriesFactory::random(),
                'plat' => PlateformeFactory::randomRange(1, 3),
            ];
        });
    }
}
