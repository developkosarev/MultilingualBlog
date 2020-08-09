<?php

namespace App\Repository;

use App\Entity\Accum\Stock;
use App\Repository\Base\BaseAccumRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

class StockRepository extends BaseAccumRepository
{
    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager)
    {
        $this->accumEntityName = Stock::class;

        parent::__construct($registry, $entityManager);
    }

    //public function deleteV1(BaseDoc $doc)
    //{
    //    $query = $this->em->createQuery('DELETE App\Entity\Accum\Stock s WHERE s.recorderInvoice = :recorder');
    //    $query->setParameter('recorder', $doc);
    //    $countUpdate = $query->getResult();
    //}
}
