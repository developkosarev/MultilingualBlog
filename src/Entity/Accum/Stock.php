<?php

namespace App\Entity\Accum;

use App\Entity\Base\AbstractAccum;
use App\Entity\Doc\Invoice\Invoice;
use App\Entity\Doc\Order\Order;
use App\Entity\Ref\Product\Product;
use App\Entity\Ref\Warehouse\Warehouse;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;

/**
 * @Entity
 * @ORM\Entity(repositoryClass="App\Repository\StockRepository")
 * @ORM\Table(name="accum_stock")
 */
class Stock extends AbstractAccum
{
    #region Recorders

    /**
     * @var Invoice
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Doc\Invoice\Invoice", inversedBy="accumStocks")
     * @ORM\JoinColumn(nullable=true, name="recorder_invoice_id")
     */
    private $recorderInvoice;

    /**
     * @var Order
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Doc\Order\Order", inversedBy="accumStocks")
     * @ORM\JoinColumn(nullable=true, name="recorder_order_id")
     */
    private $recorderOrder;

    #endregion

    #region Dimensions

    /**
     * @var Product
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Ref\Product\Product",  inversedBy="stocks")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id", nullable=false)
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
     * @return Invoice
     */
    public function getRecorderInvoice(): Invoice
    {
        return $this->recorderInvoice;
    }

    /**
     * @param Invoice $recorderInvoice
     */
    public function setRecorderInvoice(Invoice $recorderInvoice): void
    {
        $this->recorderInvoice = $recorderInvoice;
    }

    /**
     * @return Order
     */
    public function getRecorderOrder(): Order
    {
        return $this->recorderOrder;
    }

    /**
     * @param Order $recorderOrder
     */
    public function setRecorderOrder(Order $recorderOrder): void
    {
        $this->recorderOrder = $recorderOrder;
    }

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

    public function getAccumTotal()
    {
        return StockTotal::class;
    }

    public static function getRecorders(): array
    {
        return [
            'recorderInvoice' => Invoice::class,
            'recorderOrder' => Order::class
        ];
    }
}
