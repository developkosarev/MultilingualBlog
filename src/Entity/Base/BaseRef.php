<?php

namespace App\Entity\Base;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\MappedSuperclass
 */
abstract class BaseRef extends AbstractRef
{
    /**
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    protected $name;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }
}