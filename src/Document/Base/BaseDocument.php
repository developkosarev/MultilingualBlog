<?php


namespace App\Document\Base;


use App\Entity\Base\BaseRef;
use Doctrine\Persistence\ObjectManager;


class BaseDocument
{
    /**
     * @var BaseRef
     */
    private $entity;

    /**
     * @var ObjectManager
     */
    private $objectManager;

    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    public function persist(): void
    {
        $this->objectManager->persist($this->entity);
    }

    public function getId()
    {
        return $this->entity->getId();
    }
}
