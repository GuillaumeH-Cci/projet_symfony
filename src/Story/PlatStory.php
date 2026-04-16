<?php

namespace App\Story;

use App\Factory\PlateformeFactory;
use Zenstruck\Foundry\Story;

/**
 * Story permettant de créer des plateformes d'exemple pour les jeux vidéo.
 */
final class PlatStory extends Story
{
    public function build(): void
    {
        $plateformes = [
            PlateformeFactory::createOne(['plat_name' => 'Amiga']),
            PlateformeFactory::createOne(['plat_name' => 'Nintendo 64']),
            PlateformeFactory::createOne(['plat_name' => 'PlayStation 1']),
            PlateformeFactory::createOne(['plat_name' => 'Xbox']),
            PlateformeFactory::createOne(['plat_name' => 'Game Boy']),
        ];

        $this->addState('plateformes', $plateformes, 'plateformes');
    }
}
