<?php

namespace App\Tests\Repository;

use App\Entity\Accum\Stock;
use App\Entity\Doc\Invoice\Invoice;
use App\Entity\Ref\Product\Product;
use App\Entity\Ref\Warehouse\Warehouse;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class StockRepositoryTest extends KernelTestCase
{
    /**
     * @var EntityManager
     */
    private $em;

    private $stockRepository;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->em = $kernel->getContainer()->get('doctrine')->getManager();
        $this->stockRepository = $this->em->getRepository(Stock::class);
    }

    public function testSave(): void
    {
        $invoice = $this->em->getRepository(Invoice::class)->findAll()[0];
        $warehouse = $this->em->getRepository(Warehouse::class)->findOneBy(['name' => 'Warehouse 001']);
        $product = $this->em->getRepository(Product::class)->findOneBy(['name' => 'Product 001']);

        $stock = new Stock();
        $stock->setPeriod(new \DateTime());
        $stock->setDebit();
        $stock->setRecorderInvoice($invoice);
        $stock->setWarehouse($warehouse);
        $stock->setProduct($product);
        $stock->setQuantity(1);

        $this->stockRepository->add($stock);

        $stock = new Stock();
        $stock->setPeriod(new \DateTime());
        $stock->setCredit();
        $stock->setRecorderInvoice($invoice);
        $stock->setWarehouse($warehouse);
        $stock->setProduct($product);
        $stock->setReservedQuantity(1);

        $this->stockRepository->add($stock);

        $this->stockRepository->save();

        $this->assertSame(1, 1);
    }

    public function testClear(): void
    {
        $invoice = $this->em->getRepository(Invoice::class)->findAll()[0];

        $this->stockRepository->delete($invoice);
        $this->stockRepository->save();

        $this->assertSame(1, 1);
    }

    public function testUpdate(): void
    {
        $invoice = $this->em->getRepository(Invoice::class)->findAll()[0];
        $warehouse1 = $this->em->getRepository(Warehouse::class)->findOneBy(['name' => 'Warehouse 001']);
        $warehouse2 = $this->em->getRepository(Warehouse::class)->findOneBy(['name' => 'Warehouse 002']);
        $product = $this->em->getRepository(Product::class)->findOneBy(['name' => 'Product 001']);

        $this->stockRepository->delete($invoice);

        $stock = new Stock();
        $stock->setPeriod(new \DateTime());
        $stock->setDebit();
        $stock->setRecorderInvoice($invoice);
        $stock->setWarehouse($warehouse1);
        $stock->setProduct($product);
        $stock->setQuantity(1);

        $this->stockRepository->add($stock);

        $stock = new Stock();
        $stock->setPeriod(new \DateTime());
        $stock->setCredit();
        $stock->setRecorderInvoice($invoice);
        $stock->setWarehouse($warehouse2);
        $stock->setProduct($product);
        $stock->setQuantity(1);

        $this->stockRepository->add($stock);

        $this->stockRepository->save();

        $this->assertSame(1, 1);
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        // doing this is recommended to avoid memory leaks
        $this->em->close();
        $this->em = null;
    }
}
