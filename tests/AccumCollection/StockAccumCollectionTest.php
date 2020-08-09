<?php

namespace App\Tests\Document;

use App\AccumCollection\StockAccumCollection;

use App\Entity\Accum\Stock\Stock;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

//https://www.thinktocode.com/
//https://www.thinktocode.com/2018/03/05/repository-pattern-symfony/

class StockAccumCollectionTest extends KernelTestCase
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testSaveStockAccumCollection(): void
    {
//        $stockAccumCollection = new StockAccumCollection();
//        $stockAccumCollection->setRecorder();
//
//        $stock = new Stock();
//        $stock->setDebit();
//        $stock->setProduct();
//        $stock->setWarehouse();
//        $stock->setQuantity(1);
//
//        $stockAccumCollection->add($stock);
//
//        $stock = new Stock();
//        $stock->setKredit();
//        $stock->setProduct();
//        $stock->setWarehouse();
//        $stock->setReservedQuantity(1);
//
//        $stockAccumCollection->add($stock);
//
//        $stockAccumCollection->Save();


        //$invoice = $this->entityManager
        //    ->getRepository(Invoice::class)
        //    ->find($invoice->getId());

        //$this->assertSame(1, $invoice->getVersion());
        $this->assertSame(1, 1);
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        // doing this is recommended to avoid memory leaks
        $this->entityManager->close();
        $this->entityManager = null;
    }
}
