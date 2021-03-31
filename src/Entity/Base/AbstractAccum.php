<?php

namespace App\Entity\Base;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(name="period", type="datetime", nullable=false)
     */
    private $period;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $recorder;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $recordKind;

    public function __construct()
    {
        $this->period = new \DateTime();
        $this->fillResources();
    }

    abstract public function getDimensions(): array;

    abstract public function getResources(): array;

    abstract public function getAccumTotal();

    abstract public static function getRecorders(): array;

    public function getPeriod(): \DateTime
    {
        return $this->period;
    }

    public function setPeriod(\DateTime $period): self
    {
        $this->period = $period;
        return $this;
    }

    public function getKind(): int
    {
        return $this->recordKind;
    }

    public function setDebit(): self
    {
        $this->recordKind = 1;
        return $this;
    }

    public function setCredit(): self
    {
        $this->recordKind = -1;
        return $this;
    }

    private function fillResources()
    {
        $resources = $this->getResources();

        foreach ($resources as $resource) {
            $this->$resource = 0;
        }
    }
}
