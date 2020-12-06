<?php

namespace App\Entity\Accum;

use App\Entity\Base\AbstractAccumTotal;
use App\Entity\Ref\Product\Product;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * @Entity
 * @ORM\Entity(repositoryClass="App\Repository\CostTotalRepository")
 * @ORM\Table(name="accum_cost_total")
 */
class CostTotal extends AbstractAccumTotal
{
    use CostBase;

    //*  uniqueConstraints={@UniqueConstraint(name="dimensions_idx", columns={"period", "product_id"})})
}
