<?php

namespace App\Entity\Ref\Product;

use App\Base\Interfaces\CodeRefInterface;
use App\Entity\Accum\Cost;
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
class Product extends BaseRef implements CodeRefInterface
{
    /**
     * @ORM\Column(name="code", type="string", length=10, nullable=false)
     */
    private $code;

    /**
     * @var Stock
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Accum\Stock", mappedBy="product")
     */
    private $stocks;

    /**
     * @var Cost
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Accum\Cost", mappedBy="product")
     */
    private $costs;

    public function __construct()
    {
        $this->stocks = new ArrayCollection();
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code)
    {
        $this->code = $code;
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

    /**
     * @return Cost
     */
    public function getCosts(): Cost
    {
        return $this->costs;
    }

    /**
     * @param Cost $costs
     */
    public function setCosts(Cost $costs): void
    {
        $this->costs = $costs;
    }
}
