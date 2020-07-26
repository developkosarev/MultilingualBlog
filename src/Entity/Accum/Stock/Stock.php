<?php


namespace App\Entity\Accum\Stock;


use App\Entity\Doc\Invoice\Invoice;
use App\Entity\Doc\Order\Order;
use App\Entity\Ref\Product\Product;
use App\Entity\Ref\Warehouse\Warehouse;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;

use App\Entity\Base\AbstractAccum;

/**
 * @Entity
 * @ORM\Table(name="accum_stock")
 */
class Stock extends AbstractAccum
{
    /**
     * @var Invoice
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Doc\Invoice\Invoice")
     * @ORM\JoinColumn(nullable=true)
     */
    private $invoice;

    /**
     * @var Order
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Doc\Order\Order")
     * @ORM\JoinColumn(nullable=true)
     */
    private $order;

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

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", scale=3, nullable=false, name="quantity")
     */
    private $quantity;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", scale=3, nullable=false, name="reserved_quantity")
     */
    private $reservedQuantity;
}
