<?php

namespace App\Tests\Service;

use App\Base\AccumCollection\AbstractAccumCollection;
use App\Entity\Accum\Stock;
use App\Entity\Doc\Invoice\Invoice;
use App\Entity\Ref\Product\Product;
use App\Entity\Ref\Warehouse\Warehouse;
use App\Service\StockService;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class StockServiceTest extends KernelTestCase
{
    /**
     * @var EntityManager
     */
    protected static $entityManager;

    private $invoice;

    private $collection;

    public static function setUpBeforeClass(): void
    {
        $kernel = static::createKernel();
        $kernel->boot();

        $container = $kernel->getContainer();
        self::$entityManager = $container->get('doctrine')->getManager();
    }

    public function testSave()
    {
        $this->getTestCollection();

        $stockService = new StockService(self::$entityManager);
        $stockService->setRecorder($this->invoice);
        $stockService->save($this->collection);

        $this->assertTrue(true);
    }

    public function testClear()
    {
        $this->getTestCollection();

        $stockService = new StockService(self::$entityManager);
        $stockService->setRecorder($this->invoice);
        $stockService->clear();

        $this->assertTrue(true);
    }

    private function getTestCollection()
    {
        $this->invoice = self::$entityManager->getRepository(Invoice::class)->findAll()[0];

        $warehouse001 = self::$entityManager->getRepository(Warehouse::class)->find(1);
        $product001   = self::$entityManager->getRepository(Product::class)->find(1);
        $product002   = self::$entityManager->getRepository(Product::class)->find(2);
        $product003   = self::$entityManager->getRepository(Product::class)->find(3);

        $this->collection = new AbstractAccumCollection();

        $stock = new Stock();
        $stock->setPeriod(new \DateTime());
        $stock->setDebit();
        $stock->setWarehouse($warehouse001);
        $stock->setProduct($product001);
        $stock->setQuantity(1);

        $this->collection->add($stock);

        $stock = new Stock();
        $stock->setPeriod(new \DateTime());
        $stock->setDebit();
        $stock->setWarehouse($warehouse001);
        $stock->setProduct($product001);
        $stock->setQuantity(2);

        $this->collection->add($stock);

        $stock = new Stock();
        $stock->setPeriod(new \DateTime());
        $stock->setDebit();
        $stock->setWarehouse($warehouse001);
        $stock->setProduct($product002);
        $stock->setQuantity(3);

        $this->collection->add($stock);

        $stock = new Stock();
        $stock->setPeriod(new \DateTime());
        $stock->setCredit();
        $stock->setWarehouse($warehouse001);
        $stock->setProduct($product003);
        $stock->setQuantity(4);

        $this->collection->add($stock);
    }
}
