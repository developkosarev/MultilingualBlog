<?php

namespace App\Components\AccumulationRegister;

use App\Entity\Accum\CostTotal;

abstract class AccumulationRegisterFactory
{
    public static function get()
    {
        new Cost(Cost::class, CostTotal::class);
    }
}