<?php

namespace App\Repository\Base;

use App\Entity\Base\BaseRef;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

class BaseRefRepository extends ServiceEntityRepository
{
    protected $baseRef;

    private $entityManager;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;

        parent::__construct($registry, $this->baseRef);
    }

    public function findOneByName(string $name)
    {
        return $this->findOneBy(['name' => $name]);
    }

    public function save(BaseRef $ref)
    {
        $this->entityManager->persist($ref);
        $this->entityManager->flush();
    }
}
