<?php

namespace App\DataFixtures;

use App\Entity\Doc\Invoice\Invoice;
use App\Entity\Doc\Order\Order;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class OrderFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 20; $i++) {
            $order = new Order();

            $manager->persist($order);
            $manager->flush();
        }
    }

    public function getDependencies()
    {
        return array(
            UserFixtures::class,
            PostFixtures::class,
            WarehouseFixtures::class
        );
    }
}
