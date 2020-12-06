<?php

namespace App\Repository;

use App\Entity\Accum\Cost;
use App\Base\Repository\BaseAccumRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class CostRepository extends BaseAccumRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        $this->accumEntityName = Cost::class;

        parent::__construct($registry);
    }
}
