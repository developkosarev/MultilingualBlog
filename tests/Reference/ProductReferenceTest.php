<?php

namespace App\Tests\Reference;

use App\Entity\Ref\Product\Product;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ProductReferenceTest extends KernelTestCase
{
    /**
     * @var EntityManager
     */
    private $em;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->em = $kernel->getContainer()->get('doctrine')->getManager();
    }

    public function testSaveProduct(): void
    {
        $product = new Product();
        $product->setName('Product save test');

        $this->em->persist($product);
        $this->em->flush();

        $newProduct = $this->em->getRepository(Product::class)
            ->find($product->getId());

        $this->assertSame(1, $newProduct->getVersion());
        //$this->assertSame(1, 1);
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        // doing this is recommended to avoid memory leaks
        $this->em->close();
        $this->em = null;
    }
}
