<?php

namespace App\Entity\Doc\Invoice;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use App\Entity\Base\BaseDoc;

/**
 * @Entity
 * @ORM\Entity(repositoryClass="App\Repository\InvoiceRepository")
 * @ORM\Table(name="doc_invoice")
 */
class Invoice extends BaseDoc
{
    /**
     * @var float
     *
     * @ORM\Column(type="decimal", scale=2, nullable=false, name="total_sum")
     */
    private $totalSum = 0;

    /**
     * @var ArrayCollection $invoiceProducts
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Doc\Invoice\InvoiceProduct", mappedBy="owner", cascade={"persist"})
     */
    protected $invoiceProducts;

    /**
     * @var ArrayCollection $accumStocks
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Accum\Stock", mappedBy="recorderInvoice", cascade={"persist"})
     */
    protected $accumStocks;


    public function __construct()
    {
        parent::__construct();

        $this->invoiceProducts = new ArrayCollection();
        $this->accumStocks = new ArrayCollection();
    }

    public function getInvoiceProducts()
    {
        return $this->invoiceProducts;
    }

    public function addInvoiceProducts(InvoiceProduct $invoiceProduct)
    {
        $this->invoiceProducts->add($invoiceProduct);

        $invoiceProduct->setOwner($this);
        $invoiceProduct->setLineNo($this->invoiceProducts->count());
    }

    /**
     * @return float
     */
    public function getTotalSum(): float
    {
        return $this->totalSum;
    }

    /**
     * @param float $totalSum
     */
    public function setTotalSum(float $totalSum): void
    {
        $this->totalSum = $totalSum;
    }

}
