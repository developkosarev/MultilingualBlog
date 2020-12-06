<?php

namespace App\Tests\Service;

use App\AccumCollection\CostAccumCollection;
use App\Entity\Accum\Cost;
use App\Entity\Doc\Invoice\Invoice;
use App\Entity\Ref\Product\Product;
use App\Service\CostService;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CostServiceTest extends KernelTestCase
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

        $costService = new CostService(self::$entityManager);
        $costService->setRecorder($this->invoice);
        $costService->save($this->collection);

        $this->assertTrue(true);
    }

    public function testClear()
    {
        $this->getTestCollection();

        $costService = new CostService(self::$entityManager);
        $costService->setRecorder($this->invoice);
        $costService->clear();

        $this->assertTrue(true);
    }

    private function getTestCollection()
    {
        $this->invoice = self::$entityManager->getRepository(Invoice::class)->findAll()[0];

        $product001   = self::$entityManager->getRepository(Product::class)->find(1);
        $product002   = self::$entityManager->getRepository(Product::class)->find(2);

        $this->collection = new CostAccumCollection();

        $cost = new Cost();
        $cost->setPeriod(new \DateTime());
        $cost->setDebit();
        $cost->setProduct($product001);
        $cost->setQuantity(1);
        $cost->setCost(100);

        $this->collection->add($cost);

        $cost = new Cost();
        $cost->setPeriod(new \DateTime());
        $cost->setDebit();
        $cost->setProduct($product001);
        $cost->setQuantity(2);
        $cost->setCost(200);

        $this->collection->add($cost);

        $cost = new Cost();
        $cost->setPeriod(new \DateTime());
        $cost->setDebit();
        $cost->setProduct($product002);
        $cost->setQuantity(3);
        $cost->setCost(300);

        $this->collection->add($cost);
    }
}
