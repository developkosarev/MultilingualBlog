<?php

namespace App\Repository;

use App\Base\Repository\BaseAccumTotalRepository;
use App\Entity\Accum\CostTotal;
use Doctrine\Common\Persistence\ManagerRegistry;

class CostTotalRepository extends BaseAccumTotalRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        $this->accumEntityName = CostTotal::class;

        parent::__construct($registry);
    }

}
