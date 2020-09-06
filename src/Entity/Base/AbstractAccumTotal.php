<?php

namespace App\Entity\Base;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Version;

/**
 * @ORM\MappedSuperclass
 */
abstract class AbstractAccumTotal
{
    const CURRENT_DATE = '5999-01-01';

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

    public function __construct()
    {
        $this->period = new \DateTime(AbstractAccumTotal::CURRENT_DATE);
        $this->fillResources();
    }

    abstract public function getDimensions(): array;

    abstract public function getResources(): array;

    public function fillResources()
    {
        $resources = $this->getResources();

        foreach ($resources as $resource) {
            $this->$resource = 0;
        }
    }
}
