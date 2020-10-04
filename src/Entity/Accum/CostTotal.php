<?php

namespace App\Entity\Accum;

use App\Entity\Base\AbstractAccumTotal;
use App\Entity\Ref\Product\Product;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * @Entity
 * @ORM\Table(name="accum_cost_total")
 */
class CostTotal extends AbstractAccumTotal
{
    //*  uniqueConstraints={@UniqueConstraint(name="dimensions_idx", columns={"period", "product_id"})})
    #region Dimensions

    /**
     * @var Product
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Ref\Product\Product")
     * @ORM\JoinColumn(nullable=false)
     */
    private $product;

    #endregion

    #region Resources

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", scale=3, nullable=false, name="quantity")
     */
    protected $quantity;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", scale=2, nullable=false, name="cost")
     */
    protected $cost;

    #endregion

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @param Product $product
     */
    public function setProduct(Product $product): void
    {
        $this->product = $product;
    }

    /**
     * @return float
     */
    public function getQuantity(): float
    {
        return $this->quantity;
    }

    /**
     * @param float $quantity
     */
    public function setQuantity(float $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return float
     */
    public function getCost(): float
    {
        return $this->cost;
    }

    /**
     * @param float $cost
     */
    public function setCost(float $cost): void
    {
        $this->cost = $cost;
    }

    public function getDimensions(): array
    {
        return ['product'];
    }

    public function getResources(): array
    {
        return ['quantity', 'cost'];
    }
}
