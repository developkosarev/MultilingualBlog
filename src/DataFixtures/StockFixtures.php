<?php

namespace App\DataFixtures;

use App\Entity\Accum\Stock;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class StockFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        //1
        $stock = new Stock();
        $stock->setPeriod(new \DateTime());
        $stock->setRecorderInvoice($this->getReference(InvoiceFixtures::INVOICE1_REFERENCE));
        $stock->setWarehouse($this->getReference(WarehouseFixtures::WAREHOUSE1_REFERENCE));
        $stock->setProduct($this->getReference(ProductFixtures::PRODUCT1_REFERENCE));
        $stock->setQuantity(1);
        $manager->persist($stock);

        //2
        $stock = new Stock();
        $stock->setPeriod(new \DateTime());
        $stock->setRecorderOrder($this->getReference(OrderFixtures::ORDER1_REFERENCE));
        $stock->setWarehouse($this->getReference(WarehouseFixtures::WAREHOUSE1_REFERENCE));
        $stock->setProduct($this->getReference(ProductFixtures::PRODUCT1_REFERENCE));
        $stock->setReservedQuantity(1);
        $manager->persist($stock);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProductFixtures::class,
            WarehouseFixtures::class,
            InvoiceFixtures::class,
            OrderFixtures::class
        );
    }
}
