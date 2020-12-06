<?php

namespace App\Components\AccumulationRegister;

use App\Base\AccumulationRegister\AbstractAccumulationRegister;
use App\Entity\Accum\CostTotal;

abstract class AccumulationRegisterFactory
{
    const REGISTER_COST = 'REGISTER_COST';
    const REGISTER_STOCK = 'REGISTER_STOCK';

    public function getRegister(string $type): AbstractAccumulationRegister
    {
        switch ($type) {
            case AccumulationRegisterFactory::REGISTER_COST:
                //$register = new AbstractAccumulationRegister(class::Cost);
                break;
            case AccumulationRegisterFactory::REGISTER_STOCK:
                //$register = new InvestmentContract($this->container, $this->templating);
                break;
            default:
                throw new \Exception("Register not found for the type '" . $type . "'");
        }

        return $register;
    }

//    public static function get()
//    {
//        new Cost(Cost::class, CostTotal::class);
//    }
}