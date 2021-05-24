<?php

namespace App\Tests\Service;

use App\Entity\Doc\Invoice\Invoice;
use App\Entity\Doc\Invoice\InvoiceProduct;
use App\Entity\Ref\Product\Product;
use App\Repository\ProductRepository;
use App\Service\Doc\InvoiceService;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class InvoiceServiceTest extends KernelTestCase
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

    public function testSaveInvoice()
    {
        $invoiceRepository = $this->entityManager->getRepository(Invoice::class);

        $invoice = new Invoice();

        $invoiceService = new InvoiceService($invoiceRepository);
        $invoiceService->save($invoice);

        $invoiceResult = $invoiceRepository->find($invoice->getId());

        $this->assertSame(1, $invoiceResult->getVersion());
    }

    public function testDoubleSaveInvoice()
    {
        $invoiceRepository = $this->entityManager->getRepository(Invoice::class);

        $invoice = new Invoice();

        $invoiceService = new InvoiceService($invoiceRepository);
        $invoiceService->save($invoice);

        $invoice->setMarked(true);
        $invoiceService->save($invoice);

        $this->assertSame(2, $invoice->getVersion());
    }

    public function testSaveTableProduct()
    {
        $invoiceRepository = $this->entityManager->getRepository(Invoice::class);
        $invoiceService = new InvoiceService($invoiceRepository);

        $productRepository = $this->entityManager->getRepository(Product::class);
        $product = $productRepository->findOneByName('Product 001');

        $invoice = new Invoice();

        $invoiceProduct = new InvoiceProduct();
        $invoiceProduct->setProduct($product);
        $invoiceProduct->setQuantity(2);
        $invoiceProduct->setPrice(10);
        $invoice->addInvoiceProducts($invoiceProduct);

        $invoiceService->saveDocument($invoice);

        $this->assertSame(20.0, $invoice->getTotalSum());
        //$this->assertTrue(true);
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        // doing this is recommended to avoid memory leaks
        $this->entityManager->close();
        $this->entityManager = null;
    }
}
