<?php

namespace App\Tests\Repository;

use App\Entity\Doc\Invoice\Invoice;
use App\Entity\Doc\Invoice\InvoiceProduct;
use App\Entity\Ref\Product\Product;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class InvoiceRepositoryTest extends KernelTestCase
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
        $invoiceRepository = $this->entityManager->getRepository(Invoice::class);
        $productRepository = $this->entityManager->getRepository(Product::class);

        $product = $productRepository->findOneByName('Product 001');

        $invoice = new Invoice();
        $invoiceProduct = new InvoiceProduct();

        $invoiceProduct->setProduct($product);
        $invoiceProduct->setQuantity(1);
        $invoiceProduct->setPrice(10);

        $invoice->addInvoiceProducts($invoiceProduct);

        $invoiceRepository->save($invoice);

        $this->assertSame(1, $invoice->getVersion());
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        // doing this is recommended to avoid memory leaks
        $this->entityManager->close();
        $this->entityManager = null;
    }
}
