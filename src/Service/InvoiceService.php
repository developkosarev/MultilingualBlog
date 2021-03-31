<?php


namespace App\Service;


use App\Entity\Doc\Invoice\Invoice;
use Doctrine\ORM\EntityManager;

class InvoiceService
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getSomething(): Invoice
    {
        $invoice = $this->entityManager
            ->getRepository(Invoice::class)
            ->findOneBy(['title' => 'blah']);
    }

    public function update(Invoice $invoice): void
    {
        $this->entityManager->persist($invoice);
        $this->entityManager->flush(); // Debatable if should be here (for another blog post?)

        // Dispatch some event on every update
    }

}
