<?php

namespace App\Entity\Ref\Product;

use App\Entity\Base\BaseRef;
use App\Entity\Accum\Stock;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;

/**
 * @Entity
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 * @ORM\Table(name="ref_product")
 */
class Product extends BaseRef
{
    /**
     * @var Stock
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Accum\Stock", mappedBy="product")
     */
    private $stocks;

    public function __construct()
    {
        $this->stocks = new ArrayCollection();
    }

    /**
     * @return Stock
     */
    public function getStocks(): Stock
    {
        return $this->stocks;
    }

    /**
     * @param Stock $stocks
     */
    public function setStocks(Stock $stocks): void
    {
        $this->stocks = $stocks;
    }
}
