<?php


namespace App\Service;

use App\Base\AccumCollection\AbstractAccumCollection;
use App\Base\Services\AbstractAccumService;
use App\Entity\Accum\Stock;
use App\Entity\Accum\StockTotal;
use Doctrine\ORM\EntityManager;

class StockService extends AbstractAccumService
{
    protected function getEntityClass()
    {
        return Stock::class;
    }

    protected function getEntityTotalClass()
    {
        return StockTotal::class;
    }

//    public function getSomething(): Invoice
//    {
//        $invoice = $this->entityManager
//            ->getRepository(Invoice::class)
//            ->findOneBy(['title' => 'blah']);
//    }
//
//    public function update(Invoice $invoice): void
//    {
//        $this->entityManager->persist($invoice);
//        $this->entityManager->flush(); // Debatable if should be here (for another blog post?)
//
//        // Dispatch some event on every update
//    }

}
