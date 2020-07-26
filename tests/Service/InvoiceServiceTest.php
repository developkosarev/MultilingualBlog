<?php

namespace App\Tests\Service;

use App\Entity\Doc\Invoice\Invoice;
use App\Service\InvoiceService;

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

    public function testSomething()
    {
        //$invoiceService = new InvoiceService();
        //$result = $invoiceService->Save();

        $this->assertTrue(true);
    }

    public function testSaveInvoice()
    {
        //$invoice = new Invoice();
        //$this->entityManager->persist($invoice);
        //$this->entityManager->flush();

        //$invoice = $this->entityManager
        //    ->getRepository(Invoice::class)
        //    ->find($invoice->getId());

        //$this->assertSame(1, $invoice->getVersion());
        $this->assertTrue(true);
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        // doing this is recommended to avoid memory leaks
        $this->entityManager->close();
        $this->entityManager = null;
    }
}
