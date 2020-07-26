<?php


namespace App\Entity\Doc\Invoice;


use App\Entity\Base\AbstractTable;
use App\Entity\Ref\Product\Product;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;


/**
 * @Entity
 * @ORM\Table(name="doc_invoice_product")
 */
class InvoiceProduct extends AbstractTable
{
    /**
     * @var Invoice
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Doc\Invoice\Invoice")
     */
    protected $owner;

    /**
     * @var Product
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Ref\Product\Product")
     * @ORM\JoinColumn(nullable=false)
     */
    private $product;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", scale=3, nullable=false, name="quantity")
     */
    private $quantity = 0;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", scale=2, nullable=false, name="price")
     */
    private $price = 0;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", scale=2, nullable=false, name="sum")
     */
    private $sum = 0;

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
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;

        $sum = $this->getQuantity()*$this->getPrice();
        $this->setSum($sum);
    }

    /**
     * @return float
     */
    public function getSum(): float
    {
        return $this->sum;
    }

    /**
     * @param float $sum
     */
    public function setSum(float $sum): void
    {
        $this->sum = $sum;
    }
}
