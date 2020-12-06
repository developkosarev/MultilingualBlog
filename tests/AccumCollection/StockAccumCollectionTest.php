<?php

namespace App\Tests\AccumCollection;

use App\AccumCollection\StockAccumCollection;
use App\Entity\Accum\Stock;
use App\Entity\Ref\Product\Product;
use App\Entity\Ref\Warehouse\Warehouse;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

//https://habr.com/ru/post/518242/

class StockAccumCollectionTest extends KernelTestCase
{
    public function testTotalOneItemAccumCollection(): void
    {
        $warehouse001 = new Warehouse();
        $warehouse001->setId(1);

        $product001 = new Product();
        $product001->setId(1);

        $product002 = new Product();
        $product002->setId(2);

        $stockAccumCollection = new StockAccumCollection();

        $stock = new Stock();
        $stock->setPeriod(new \DateTime());
        $stock->setDebit();
        $stock->setWarehouse($warehouse001);
        $stock->setProduct($product001);
        $stock->setQuantity(1);

        $stockAccumCollection->add($stock);

        $stock = new Stock();
        $stock->setPeriod(new \DateTime());
        $stock->setDebit();
        $stock->setWarehouse($warehouse001);
        $stock->setProduct($product001);
        $stock->setQuantity(1);

        $stockAccumCollection->add($stock);

        $this->assertCount(1, $stockAccumCollection->getItemsTotal());

        $stockTotal = $stockAccumCollection->getItemsTotal()->first();
        $this->assertSame(2.000, $stockTotal->getQuantity());
    }

    public function testTotalTwoItemAccumCollection(): void
    {
        $warehouse001 = new Warehouse();
        $warehouse001->setId(1);

        $product001 = new Product();
        $product001->setId(1);

        $product002 = new Product();
        $product002->setId(2);

        $stockAccumCollection = new StockAccumCollection();

        $stock = new Stock();
        $stock->setPeriod(new \DateTime());
        $stock->setDebit();
        $stock->setWarehouse($warehouse001);
        $stock->setProduct($product001);
        $stock->setQuantity(1);

        $stockAccumCollection->add($stock);

        $stock = new Stock();
        $stock->setPeriod(new \DateTime());
        $stock->setDebit();
        $stock->setWarehouse($warehouse001);
        $stock->setProduct($product002);
        $stock->setQuantity(1);

        $stockAccumCollection->add($stock);

        $this->assertCount(2, $stockAccumCollection->getItemsTotal());

        $stockTotal = $stockAccumCollection->getItemsTotal()->first();
        $this->assertSame(1.000, $stockTotal->getQuantity());
    }
}
