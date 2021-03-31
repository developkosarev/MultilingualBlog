<?php

namespace App\Base\EventSubscriber;

use App\Base\Interfaces\CodeGeneratorInterface;
use App\Base\Interfaces\CodeRefInterface;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;

//https://www.doctrine-project.org/projects/doctrine-orm/en/2.7/reference/events.html

class CodeGenerate implements EventSubscriber
{
    private $generator;

    public function __construct(CodeGeneratorInterface $generator)
    {
        $this->generator = $generator;
    }

    public function getSubscribedEvents()
    {
        return array(
            Events::prePersist,
        );
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if ($entity instanceof CodeRefInterface) {
            $newCode = $this->generator->generateCode();
            $entity->setCode($newCode);
        }
    }
}