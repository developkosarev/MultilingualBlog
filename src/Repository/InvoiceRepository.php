<?php

namespace App\Repository;

use App\Entity\Doc\Invoice\Invoice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

class InvoiceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Invoice::class);
    }

    public function save(Invoice $invoice)
    {
        $invoice->setTotalSum(0);
        foreach ($invoice->getInvoiceProducts() as $item) {
            $invoice->setTotalSum($invoice->getTotalSum() + $item->getSum());
        }

        $this->_em->persist($invoice);
        $this->_em->flush();
    }
}
