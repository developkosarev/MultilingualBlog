<?php

namespace App\Repository;

use App\Entity\Accum\Stock;
use App\Entity\Ref\Product\Product;
use App\Entity\Ref\Warehouse\Warehouse;
use App\Base\Repository\BaseAccumRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\Query\ResultSetMappingBuilder;

class StockRepository extends BaseAccumRepository
{
    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager)
    {
        $this->accumEntityName = Stock::class;

        parent::__construct($registry, $entityManager);
    }

    public function getTotal()
    {
        $sql = 'SELECT CONCAT(s.product_id, s.warehouse_id) as id, s.product_id, s.warehouse_id,
                       SUM(s.quantity) AS quantity, SUM(s.reserved_quantity) AS reserved_quantity, 
                       p.name AS p_name, 
                       w.name AS w_name 
                FROM accum_stock s
                    LEFT JOIN ref_product p ON p.id = s.product_id
                    LEFT JOIN ref_warehouse w ON w.id = s.warehouse_id
                GROUP BY s.product_id, s.warehouse_id'
        ;

        $rsm = new ResultSetMapping();

        $rsm->addEntityResult(Stock::class, 's');
        $rsm->addFieldResult('s', 'id', 'id');
        $rsm->addFieldResult('s', 'quantity', 'quantity');
        $rsm->addFieldResult('s', 'reserved_quantity', 'reservedQuantity');

        $rsm->addJoinedEntityResult(Product::class, 'p', 's', 'product');
        $rsm->addFieldResult('p', 'product_id', 'id');
        //$rsm->addFieldResult('p', 'p_name', 'name');

        $rsm->addJoinedEntityResult(Warehouse::class, 'w', 's', 'warehouse');
        $rsm->addFieldResult('w', 'warehouse_id', 'id');
        //$rsm->addFieldResult('w', 'w_name', 'name');


        $rsm = new ResultSetMappingBuilder($this->_em);

        $rsm->addScalarResult('product_id', 'product_id', 'integer');
        $rsm->addScalarResult('warehouse_id', 'warehouse_id', 'integer');
        $rsm->addScalarResult('quantity', 'quantity', 'float');
        $rsm->addScalarResult('reserved_quantity', 'reserved_quantity', 'float');

        $query = $this->_em->createNativeQuery($sql, $rsm);

        return $query->getResult();
    }

    public function getTotalV2()
    {
        $sql = 'SELECT s.product_id, s.warehouse_id,
                       SUM(s.quantity) AS quantity, SUM(s.reserved_quantity) AS reserved_quantity 
                FROM accum_stock s
                GROUP BY s.product_id, s.warehouse_id'
        ;

        $sql = 'SELECT CONCAT(s.product_id, s.warehouse_id) as id, s.product_id, s.warehouse_id,
                       SUM(s.quantity) AS quantity, SUM(s.reserved_quantity) AS reserved_quantity, 
                       p.name AS p_name, 
                       w.name AS w_name 
                FROM accum_stock s
                    LEFT JOIN ref_product p ON p.id = s.product_id
                    LEFT JOIN ref_warehouse w ON w.id = s.warehouse_id
                GROUP BY s.product_id, s.warehouse_id'
        ;

        $rsm = new ResultSetMapping();

        $rsm->addEntityResult(Stock::class, 's');
        $rsm->addFieldResult('s', 'id', 'id');
        $rsm->addFieldResult('s', 'quantity', 'quantity');
        $rsm->addFieldResult('s', 'reserved_quantity', 'reservedQuantity');

        $rsm->addJoinedEntityResult(Product::class, 'p', 's', 'product');
        $rsm->addFieldResult('p', 'product_id', 'id');
        //$rsm->addFieldResult('p', 'p_name', 'name');

        $rsm->addJoinedEntityResult(Warehouse::class, 'w', 's', 'warehouse');
        $rsm->addFieldResult('w', 'warehouse_id', 'id');
        //$rsm->addFieldResult('w', 'w_name', 'name');

        $query = $this->_em->createNativeQuery($sql, $rsm);

        //$rsm = new Query\ResultSetMapping();
        //$rsm->addEntityResult(Department::class, 'd');
        //$rsm->addFieldResult('d', 'dept_no', 'deptNo');
        //$rsm->addFieldResult('d', 'dept_name', 'deptName');

        //$query = $this->_em->createNativeQuery($sql, $rsm);

        return $query->getResult();
    }

    public function getTotalV1()
    {
        $qb = $this->createQueryBuilder('s')
            ->select('IDENTITY(s.product) AS productId, IDENTITY(s.warehouse) AS warehouseId')
            ->addSelect('SUM(s.quantity) AS quantity, SUM(s.reservedQuantity) AS reservedQuantity')
            //->addSelect('IDENTITY(s.product) AS ')
            //->addSelect('SUM(a.quantity) AS quantityTotal, SUM(a.reserved_quantity) AS reservedQuantityTotal')
            ->groupBy('s.product, s.warehouse')
        ;

        return $qb->getQuery()->getResult();
    }

    //https://habr.com/ru/post/496166/
    //public function deleteV1(BaseDoc $doc)
    //{
    //    $query = $this->em->createQuery('DELETE App\Entity\Accum\Stock s WHERE s.recorderInvoice = :recorder');
    //    $query->setParameter('recorder', $doc);
    //    $countUpdate = $query->getResult();
    //}
}
