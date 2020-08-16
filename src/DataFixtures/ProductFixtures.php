<?php

namespace App\DataFixtures;

use App\Entity\Ref\Product\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class ProductFixtures extends Fixture
{
    public const PRODUCT1_REFERENCE = 'product-1';
    public const PRODUCT2_REFERENCE = 'product-2';
    public const PRODUCT3_REFERENCE = 'product-3';

    public function load(ObjectManager $manager)
    {
        $this->loadProducts($manager);
    }

    private function loadProducts(ObjectManager $manager): void
    {
        foreach ($this->getProducts() as [$name, $reference]) {
            $product = new Product();
            $product->setName($name);

            $manager->persist($product);
            $manager->flush();

            $this->addReference($reference, $product);
        }

        for ($i = 100; $i <= 200; $i++) {
            $name = sprintf("Product list %'.03d", $i);

            $product = new Product();
            $product->setName($name);

            $manager->persist($product);
        }

        $manager->flush();
    }

    private function getProducts(): array
    {
        return [
            ['Product 001', self::PRODUCT1_REFERENCE],
            ['Product 002', self::PRODUCT2_REFERENCE],
            ['Product 003', self::PRODUCT3_REFERENCE],
        ];
    }
}
