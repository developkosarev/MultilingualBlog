<?php

namespace App\Components\AccumulationRegister;

use App\Base\AccumulationRegister\AbstractAccumulationRegister;

class Stock extends AbstractAccumulationRegister
{
    private $product;

    private $warehouse;

    private $quantity;

    private $reservedQuantity;

    public function getDimensions(): array
    {
        return ['product', 'warehouse'];
    }

    public function getResources(): array
    {
        return ['quantity', 'reservedQuantity'];
    }
}