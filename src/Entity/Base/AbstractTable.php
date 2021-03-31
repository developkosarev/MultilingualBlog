<?php

namespace App\Entity\Base;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\MappedSuperclass
 */
abstract class AbstractTable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @var AbstractRef
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Base\BaseRef")
     * @ORM\JoinColumn(name="owner", nullable=false)
     */
    protected $owner;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=false)
     */
    protected $lineNo;

    /**
     * @return AbstractRef
     */
    public function getOwner(): AbstractRef
    {
        return $this->owner;
    }

    /**
     * @param AbstractRef $owner
     */
    public function setOwner(AbstractRef $owner): void
    {
        $this->owner = $owner;
    }

    /**
     * @return int
     */
    public function getLineNo(): int
    {
        return $this->lineNo;
    }

    /**
     * @param int $lineNo
     */
    public function setLineNo(int $lineNo): void
    {
        $this->lineNo = $lineNo;
    }


}