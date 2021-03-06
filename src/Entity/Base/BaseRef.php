<?php

namespace App\Entity\Base;

use App\Base\Interfaces\ReferenceInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\MappedSuperclass
 */
abstract class BaseRef extends AbstractRef implements ReferenceInterface
{
    /**
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     * @Assert\NotBlank()
     */
    protected $name;

    /**
     * @Groups({"ref:name"})
     */
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