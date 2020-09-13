<?php

namespace App\Base\Repository;

use App\Entity\Base\AbstractAccumTotal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\PropertyAccess\PropertyAccess;


class BaseAccumTotalRepository extends ServiceEntityRepository
{
    private $propertyAccessor;

    private $updateQuery;

    public function __construct(ManagerRegistry $registry)
    {
        $this->propertyAccessor = PropertyAccess::createPropertyAccessor();

        $entityClass = AbstractAccumTotal::class; //???

        parent::__construct($registry, $entityClass);
    }

    private function buildUpdateQuery(AbstractAccumTotal $accum, bool $decrement = false)
    {
        $alias = 'a';

        $qb = $this->createQueryBuilder($alias)
            ->update($this->_entityName, $alias);

        $resources = $accum->getResources();
        foreach ($resources as $resource) {
            $value = $this->propertyAccessor->getValue($accum, $resource);
            $sign = $decrement ? ' - ' : ' + ';


            $field = $alias . '.' . $resource;
            $qb->set($field, $field . $sign . ':' . $resource)
               ->setParameter($resource, $value);
        }

        $dimensions = $accum->getDimensions();
        foreach ($dimensions as $dimension) {
            $value = $this->propertyAccessor->getValue($accum, $dimension);

            $field = $alias . '.' . $dimension;
            $qb->andWhere($field . ' = ' . ':' . $dimension)
                ->setParameter($dimension, $value);
        }

        $this->updateQuery = $qb->getQuery();
        //echo $this->updateQuery->getSQL();
    }

    public function increment(AbstractAccumTotal $accum)
    {
        $this->buildUpdateQuery($accum);
        $result = $this->updateQuery->execute();
        if ($result == 0) {
            $newAccum = clone $accum;
            $newAccum->fillResources();

            $this->_em->persist($newAccum);
            $this->_em->flush();

            $this->updateQuery->execute();
        }
    }

    public function decrement(AbstractAccumTotal $accum)
    {
        $this->buildUpdateQuery($accum, true);
        $result = $this->updateQuery->execute();
        if ($result == 0) {
            $newAccum = clone $accum;
            $newAccum->fillResources();

            $this->_em->persist($newAccum);
            $this->_em->flush();

            $this->updateQuery->execute();
        }
    }
}
