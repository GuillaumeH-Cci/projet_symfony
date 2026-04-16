<?php

namespace App\Factory;

use App\Entity\Plateforme;
use Zenstruck\Foundry\Persistence\PersistentObjectFactory;


/**
 * @extends PersistentObjectFactory<Plateforme>
 */
final class PlateformeFactory extends PersistentObjectFactory{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
    }

    #[\Override]    public static function class(): string
    {
        return Plateforme::class;
    }

        /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    #[\Override]    protected function defaults(): array|callable    {
        return [
            'plat_name' => self::faker()->text(255),
        ];
    }

        /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    #[\Override]    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Plateforme $plateforme): void {})
        ;
    }
}
