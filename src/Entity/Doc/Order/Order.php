<?php

namespace App\Entity\Doc\Order;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use App\Entity\Base\BaseDoc;

/**
 * @Entity
 * @ORM\Table(name="doc_order")
 */
class Order extends BaseDoc
{
    /**
     * @var ArrayCollection $accumStocks
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Accum\Stock", mappedBy="recorderOrder", cascade={"persist"})
     */
    protected $accumStocks;

    public function __construct()
    {
        parent::__construct();

        $this->accumStocks = new ArrayCollection();
    }
}
