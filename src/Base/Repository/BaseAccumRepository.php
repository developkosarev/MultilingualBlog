<?php

namespace App\Repository\Base;

use App\Entity\Base\AbstractAccum;
use App\Entity\Base\BaseDoc;
use App\Entity\Doc\Invoice\Invoice;
use App\Entity\Doc\Order\Order;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

class BaseAccumRepository extends ServiceEntityRepository
{
    //private $em;

    protected $accumEntityName;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager)
    {
        //$this->em = $entityManager;

        parent::__construct($registry, $this->accumEntityName);
    }

    public function getRecords(BaseDoc $doc): array
    {
        //$recorders = $this->accumEntityName->getRecorders;
        //foreach ($recorders as $key => $value) {
        //    echo $key;
        //    echo $value;
        //}

        $qb = $this->createQueryBuilder('accum');

        if ($doc instanceof Invoice) {
            $qb->where('accum.recorderInvoice <= :recorder');
        } elseif ($doc instanceof Order) {
            $qb->where('accum.recorderOrder <= :recorder');
        }
        $qb->setParameter('recorder', $doc);

        return $qb->getQuery()->getResult();
    }

    public function add(AbstractAccum $accum)
    {
        $this->_em->persist($accum);
    }

    public function delete(BaseDoc $doc)
    {
        $records = $this->getRecords($doc);
        foreach ($records as $item) {
            $this->_em->remove($item);
        }
    }

    public function save()
    {
        $this->_em->getConnection()->beginTransaction();
        try {
            $this->_em->flush();
            $this->_em->getConnection()->commit();
        } catch (Exception $e) {
            $this->_em->getConnection()->rollBack();
            throw $e;
        }
    }
}
