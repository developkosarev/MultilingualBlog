<?php

namespace App\Repository;

use App\Entity\Doc\Invoice\Invoice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

class InvoiceRepository extends ServiceEntityRepository
{
    private $entityManager;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;

        parent::__construct($registry, Invoice::class);
    }

    public function save(Invoice $invoice)
    {
        $invoice->setTotalSum(0);
        foreach ($invoice->getInvoiceProducts() as $item) {
            $invoice->setTotalSum($invoice->getTotalSum() + $item->getSum());
        }

        $this->entityManager->persist($invoice);
        $this->entityManager->flush();
    }
}
