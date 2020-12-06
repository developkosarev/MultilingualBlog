<?php

namespace App\Entity\Accum;

use App\Entity\Ref\Product\Product;
use Doctrine\ORM\Mapping as ORM;

trait CostBase
{
    #region Dimensions

    /**
     * @var Product
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Ref\Product\Product",  inversedBy="costs")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id", nullable=false)
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

    #region Fields

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

    #endregion

    public function getDimensions(): array
    {
        return ['product'];
    }

    public function getResources(): array
    {
        return ['quantity', 'cost'];
    }
}
