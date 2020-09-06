<?php

namespace App\Entity\Base;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Version;
use Symfony\Component\Serializer\Annotation\Groups;

//https://its.1c.ru/db/metod8dev/content/1798/hdoc
/**
 * @ORM\MappedSuperclass
 */
abstract class AbstractRef
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @Column(type="integer")
     * @Version
     */
    protected $version;

    /**
     * @Column(type="boolean", nullable=false)
     */
    protected $marked = false;

    /**
     * @Groups({"ref:id"})
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId($id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getVersion()
    {
        return $this->version;
    }

    public function getMarked()
    {
        return $this->marked;
    }

    public function setMarked(bool $marked): self
    {
        $this->marked = $marked;
        return $this;
    }
}
