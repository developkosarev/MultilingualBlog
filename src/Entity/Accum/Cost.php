<?php

namespace App\Entity\Accum;

use App\Entity\Doc\Invoice\Invoice;
use App\Entity\Doc\Order\Order;
use App\Entity\Ref\Product\Product;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use App\Entity\Base\AbstractAccum;

/**
 * @Entity
 * @ORM\Table(name="accum_cost")
 */
class Cost extends AbstractAccum
{
    #region Recorders

    /**
     * @var Invoice
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Doc\Invoice\Invoice", inversedBy="accumCosts")
     * @ORM\JoinColumn(nullable=true, name="recorder_invoice_id")
     */
    private $recorderInvoice;

    /**
     * @var Order
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Doc\Order\Order", inversedBy="accumCosts")
     * @ORM\JoinColumn(nullable=true, name="recorder_order_id")
     */
    private $recorderOrder;

    #endregion

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

    public function getAccumTotal()
    {
        return CostTotal::class;
    }

    public static function getRecorders(): array
    {
        return [
            'recorderInvoice' => Invoice::class,
            'recorderOrder' => Order::class
        ];
    }
}
