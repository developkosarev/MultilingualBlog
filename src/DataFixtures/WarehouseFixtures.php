<?php

namespace App\DataFixtures;

use App\Entity\Ref\Warehouse\Warehouse;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\Persistence\ObjectManager;

class WarehouseFixtures extends Fixture
{
    public const WAREHOUSE1_REFERENCE = 'warehouse-1';
    public const WAREHOUSE2_REFERENCE = 'warehouse-2';
    public const WAREHOUSE3_REFERENCE = 'warehouse-3';

    public function load(ObjectManager $manager)
    {
        $this->loadWarehouses($manager);
    }

    private function loadWarehouses(ObjectManager $manager): void
    {
        $manager->getClassMetadata(Warehouse::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        foreach ($this->getWarehouses() as [$id, $name, $reference]) {
            $warehouse = new Warehouse();
            $warehouse->setId($id);
            $warehouse->setName($name);

            $manager->persist($warehouse);
            $manager->flush();

            $this->addReference($reference, $warehouse);
        }

        $manager->flush();
    }

    private function getWarehouses(): array
    {
        return [
            [1, 'Warehouse 001', self::WAREHOUSE1_REFERENCE],
            [2, 'Warehouse 002', self::WAREHOUSE2_REFERENCE],
            [3, 'Warehouse 003', self::WAREHOUSE3_REFERENCE],
        ];
    }
}
