<?php

namespace App\Tests\Repository;

use App\Entity\BlogPost;
use App\Entity\Doc\Invoice\Invoice;
use App\Entity\Doc\Invoice\InvoiceProduct;
use App\Entity\Ref\Product\Product;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Happyr\DoctrineSpecification\Repository\EntitySpecificationRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class BlogPostTest extends KernelTestCase
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

    public function testSave(): void
    {
        $repository = $this->entityManager->getRepository(BlogPost::class);

        $this->assertSame(1, 1);
        $this->assertInstanceOf(EntityRepository::class, $repository);
        //$this->assertInstanceOf(EntitySpecificationRepository::class, $repository);
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        // doing this is recommended to avoid memory leaks
        $this->entityManager->close();
        $this->entityManager = null;
    }
}
