<?php

namespace App\AccumCollection;

use App\Entity\Base\AbstractAccum;
use Doctrine\Common\Collections\ArrayCollection;

class StockAccumCollection
{
    protected $items;

    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

    public function add(AbstractAccum $accum)
    {
        $this->items->add($accum);
    }
}