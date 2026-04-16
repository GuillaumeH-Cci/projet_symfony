<?php

namespace App\Story;

use App\Factory\CategoriesFactory;
use Zenstruck\Foundry\Story;

/**
 * Story permettant de créer des catégories d'exemple pour les jeux vidéo.
 */
final class CatStory extends Story
{
    public function build(): void
    {
        $categories = [
            CategoriesFactory::createOne(['cat_name' => 'Action']),
            CategoriesFactory::createOne(['cat_name' => 'RPG']),
            CategoriesFactory::createOne(['cat_name' => 'Stratégie']),
            CategoriesFactory::createOne(['cat_name' => 'Puzzle']),
            CategoriesFactory::createOne(['cat_name' => 'Plateforme']),
            CategoriesFactory::createOne(['cat_name' => 'Aventure']),   
            CategoriesFactory::createOne(['cat_name' => 'Simulation']), 
            CategoriesFactory::createOne(['cat_name' => 'Sport']),
            CategoriesFactory::createOne(['cat_name' => 'Horreur']),
            CategoriesFactory::createOne(['cat_name' => 'Multijoueur']),
        ];

        $this->addState('categories', $categories, 'categories');
    }
}
