<?php


namespace App\Repository\Base;


use App\Entity\Base\BaseDoc;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

class BaseDocRepository
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var ObjectRepository
     */
    private $objectRepository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->objectRepository = $this->entityManager->getRepository(BaseDoc::class);
    }

    public function find(int $id)
    {
        return $this->objectRepository->find($id);
    }

    public function save(BaseDoc $doc): void
    {
        $this->entityManager->persist($doc);
        $this->entityManager->flush();
    }
}