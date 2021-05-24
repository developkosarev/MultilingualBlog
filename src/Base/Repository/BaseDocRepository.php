<?php

declare(strict_types=1);

namespace App\Base\Repository;

use App\Entity\Base\BaseDoc;
use App\Base\Interfaces\DocumentInterface;
use App\Base\Interfaces\DocumentRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class BaseDocRepository extends ServiceEntityRepository implements DocumentRepositoryInterface
{
    public function __construct(ManagerRegistry $registry, string $entityClass)
    {
        parent::__construct($registry, $entityClass);
    }

    public function getById(int $id): ?DocumentInterface
    {
        return $this->find($id);
    }


    public function save(DocumentInterface $document): DocumentInterface
    {
        $this->_em->persist($document);
        $this->_em->flush();

        return $document;
    }

    public function delete(DocumentInterface $document): void
    {
        // TODO: Implement delete() method.
    }
}

//class BaseDocRepository
//{
//    /**
//     * @var EntityManagerInterface
//     */
//    private $entityManager;
//
//    /**
//     * @var ObjectRepository
//     */
//    private $objectRepository;
//
//    public function __construct(EntityManagerInterface $entityManager)
//    {
//        $this->entityManager = $entityManager;
//        $this->objectRepository = $this->entityManager->getRepository(BaseDoc::class);
//    }
//
//    public function find(int $id)
//    {
//        return $this->objectRepository->find($id);
//    }
//
//    public function save(BaseDoc $doc): void
//    {
//        $this->entityManager->persist($doc);
//        $this->entityManager->flush();
//    }
//}