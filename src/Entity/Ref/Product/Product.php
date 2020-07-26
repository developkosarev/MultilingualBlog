<?php


namespace App\Entity\Ref\Product;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;

use App\Entity\Base\BaseRef;

/**
 * @Entity
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 * @ORM\Table(name="ref_product")
 */
class Product extends BaseRef
{

}
