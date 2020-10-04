<?php

namespace App\Entity\Accum;

use App\Entity\Base\AbstractAccumTotal;
use App\Entity\Ref\Product\Product;
use App\Entity\Ref\Warehouse\Warehouse;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * @Entity
 * @ORM\Entity(repositoryClass="App\Repository\StockTotalRepository")
 * @ORM\Table(name="accum_stock_total")
 */
class StockTotal extends AbstractAccumTotal
{
    //*  uniqueConstraints={@UniqueConstraint(name="dimensions_idx", columns={"period", "product_id", "warehouse_id"})})
    #region Dimensions

    /**
     * @var Product
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Ref\Product\Product")
     * @ORM\JoinColumn(nullable=false)
     */
    private $product;

    /**
     * @var Warehouse
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Ref\Warehouse\Warehouse")
     * @ORM\JoinColumn(nullable=false)
     */
    private $warehouse;

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
     * @ORM\Column(type="decimal", scale=3, nullable=false, name="reserved_quantity")
     */
    protected $reservedQuantity;

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
     * @return Warehouse
     */
    public function getWarehouse(): Warehouse
    {
        return $this->warehouse;
    }

    /**
     * @param Warehouse $warehouse
     */
    public function setWarehouse(Warehouse $warehouse): void
    {
        $this->warehouse = $warehouse;
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
    public function getReservedQuantity(): float
    {
        return $this->reservedQuantity;
    }

    /**
     * @param float $reservedQuantity
     */
    public function setReservedQuantity(float $reservedQuantity): void
    {
        $this->reservedQuantity = $reservedQuantity;
    }

    public function getDimensions(): array
    {
        return ['product', 'warehouse'];
    }

    public function getResources(): array
    {
        return ['quantity', 'reservedQuantity'];
    }
}
