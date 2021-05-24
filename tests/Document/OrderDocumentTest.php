<?php

namespace App\Tests\Document;

use App\Entity\Doc\Order\Order;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class OrderDocumentTest extends KernelTestCase
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

    public function testRepositoryClassOrderDocument(): void
    {                
        $repository = $this->entityManager->getRepository(Order::class);
        
        $this->assertInstanceOf(EntityRepository::class, $repository);        

        //Doctrine\Bundle\DoctrineBundle\Repository\ContainerRepositoryFactory
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        // doing this is recommended to avoid memory leaks
        $this->entityManager->close();
        $this->entityManager = null;
    }
}
