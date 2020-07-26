<?php

namespace App\Repository;

use App\Entity\Ref\Product\Product;
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

}
