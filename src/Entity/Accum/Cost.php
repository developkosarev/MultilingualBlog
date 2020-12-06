<?php

namespace App\Entity\Accum;

use App\Entity\Doc\Invoice\Invoice;
use App\Entity\Doc\Order\Order;
use App\Entity\Ref\Product\Product;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Embedded;
use Doctrine\ORM\Mapping\Entity;
use App\Entity\Base\AbstractAccum;

/**
 * @Entity
 * @ORM\Entity(repositoryClass="App\Repository\CostRepository")
 * @ORM\Table(name="accum_cost")
 */
class Cost extends AbstractAccum
{
    use CostBase;

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
