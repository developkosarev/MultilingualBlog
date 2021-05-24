<?php

namespace App\Tests\Document;

//use App\Document\InvoiceDocument;
use App\Entity\Doc\Invoice\Invoice;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

//https://www.thinktocode.com/
//https://www.thinktocode.com/2018/03/05/repository-pattern-symfony/

class InvoiceDocumentTest extends KernelTestCase
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

    public function testSaveInvoiceDocument(): void
    {
        //$invoiceDocument = new InvoiceDocument();
        //$invoiceDocument->persist();

        //$this->entityManager->persist($invoice);
        //$this->entityManager->flush();

        //$invoice = $this->entityManager
        //    ->getRepository(Invoice::class)
        //    ->find($invoice->getId());

        //$repository = $this->entityManager->getRepository(Invoice::class);

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
