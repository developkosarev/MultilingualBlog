<?php

namespace App\Components\AccumulationRegister;

use App\Base\AccumulationRegister\AbstractAccumulationRegister;
use App\Entity\Ref\Product\Product;

class Cost extends AbstractAccumulationRegister
{
    private $product;

    private $quantity = 0;

    private $cost = 0;

    public function getDimensions(): array
    {
        return ['product'];
    }

    public function getResources(): array
    {
        return ['quantity', 'cost'];
    }
}