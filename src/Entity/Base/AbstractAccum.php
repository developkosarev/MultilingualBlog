<?php

namespace App\Entity\Base;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Version;

/**
 * @ORM\MappedSuperclass
 */
abstract class AbstractAccum
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $period;

    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    private $recorder;

    /**
     * @ORM\Column(type="smallint", nullable=false)
     */
    private $recordKind;

    public function __construct()
    {
        $this->period = new \DateTime();
    }

    public function getPeriod(): \DateTime
    {
        return $this->period;
    }

    public function setPeriod(\DateTime $period): self
    {
        $this->period = $period;

        return $this;
    }
}
