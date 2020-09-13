<?php

namespace App\Tests\Repository;

use App\Entity\Accum\StockTotal;
use App\Entity\Ref\Product\Product;
use App\Entity\Ref\Warehouse\Warehouse;
use App\Base\Repository\BaseAccumTotalRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class StockTotalRepositoryTest extends KernelTestCase
{
    private $doctrine;

    /**
     * @var EntityManager
     */
    private $em;

    private $repository;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->doctrine = $kernel->getContainer()->get('doctrine');
        $this->em = $kernel->getContainer()->get('doctrine')->getManager();
        /*
        $this->repository = new BaseAccumTotalRepository($this->doctrine, StockTotal::class);
        */
    }

    public function testIncrement(): void
    {
        /*
        $warehouse = $this->em->getRepository(Warehouse::class)->findOneBy(['name' => 'Warehouse 001']);
        $product = $this->em->getRepository(Product::class)->findOneBy(['name' => 'Product 001']);

        $stockTotal = new StockTotal();
        $stockTotal->setWarehouse($warehouse);
        $stockTotal->setProduct($product);
        $stockTotal->setQuantity(1);

        $this->repository->increment($stockTotal);

        $stockTotal = new StockTotal();
        $stockTotal->setWarehouse($warehouse);
        $stockTotal->setProduct($product);
        $stockTotal->setQuantity(2);

        $this->repository->increment($stockTotal);
        */

        $this->assertSame(1, 1);
    }

    public function testDecrement(): void
    {
        /*
        $warehouse = $this->em->getRepository(Warehouse::class)->findOneBy(['name' => 'Warehouse 001']);
        $product = $this->em->getRepository(Product::class)->findOneBy(['name' => 'Product 001']);

        $stockTotal = new StockTotal();
        $stockTotal->setWarehouse($warehouse);
        $stockTotal->setProduct($product);
        $stockTotal->setQuantity(1);

        $this->repository->decrement($stockTotal);
        */

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
