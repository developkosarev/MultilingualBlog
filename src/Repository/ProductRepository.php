<?php

namespace App\Repository;

use App\Entity\Ref\Product\Product;
use App\Pagination\Paginator;
use App\Repository\Base\BaseRefRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

class ProductRepository extends BaseRefRepository
{
    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager)
    {
        $this->baseRef = Product::class;

        parent::__construct($registry, $entityManager);
    }

    public function findLatest(int $page = 1, int $size = 25): Paginator
    {
        $qb = $this->createQueryBuilder('p')
            ->orderBy('p.name', 'DESC')
        ;

        return (new Paginator($qb, $size))->paginate($page);
    }

}
