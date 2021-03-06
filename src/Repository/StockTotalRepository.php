<?php

namespace App\Repository;

use App\Base\Repository\BaseAccumTotalRepository;
use App\Entity\Accum\StockTotal;
use Doctrine\Common\Persistence\ManagerRegistry;

class StockTotalRepository extends BaseAccumTotalRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        $this->accumEntityName = StockTotal::class;

        parent::__construct($registry);
    }

}
