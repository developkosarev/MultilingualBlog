<?php

namespace App\Service;

use App\Base\Services\AbstractAccumService;
use App\Entity\Accum\Cost;
use App\Entity\Accum\CostTotal;

class CostService extends AbstractAccumService
{
    protected function getEntityClass()
    {
        return Cost::class;
    }

    protected function getEntityTotalClass()
    {
        return CostTotal::class;
    }
}
