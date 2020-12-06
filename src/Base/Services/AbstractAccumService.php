<?php

namespace App\Base\Services;

use App\AccumCollection\StockAccumCollection;
use App\Base\AccumCollection\AbstractAccumCollection;
use Doctrine\ORM\EntityManagerInterface;

abstract class AbstractAccumService
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    private $objectRepository;

    private $objectTotalRepository;

    private $recorder;

//    /**
//     * @var BaseAccumRepository
//     */
//    private $repository;
//
//    /**
//     * @var BaseAccumTotalRepository
//     */
//    private $totalRepository;
//
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;

        $this->objectRepository = $this->entityManager->getRepository($this->getEntityClass());
        $this->objectTotalRepository = $this->entityManager->getRepository($this->getEntityTotalClass());
    }

    abstract protected function getEntityClass();

    abstract protected function getEntityTotalClass();

    public function setRecorder($recorder)
    {
        $this->recorder = $recorder;
    }

    public function clear()
    {
        $items = $this->objectRepository->getRecords($this->recorder);

        $collection = new AbstractAccumCollection(); //StockAccumCollection();

        foreach ($items as $item) {
            $collection->add($item);
        }

        $this->entityManager->getConnection()->beginTransaction();
        try {
            foreach ($collection->getItems() as $item) {
                $this->objectRepository->remove($item);
            }

            foreach ($collection->getItemsTotal() as $itemTotal) {
                $this->objectTotalRepository->decrement($itemTotal);
            }

            $this->entityManager->flush();
            $this->entityManager->getConnection()->commit();
        } catch (\Exception $e) {
            $this->entityManager->getConnection()->rollBack();
            throw $e;
        }
    }

    public function read()
    {

    }

    public function save(AbstractAccumCollection $items)
    {
        $this->entityManager->getConnection()->beginTransaction();
        try {
            foreach ($items->getItems() as $item) {
                $item->setRecorderInvoice($this->recorder);
                $this->objectRepository->add($item);
            }

            foreach ($items->getItemsTotal() as $itemTotal) {
                $this->objectTotalRepository->increment($itemTotal);
            }

            $this->entityManager->flush();
            $this->entityManager->getConnection()->commit();
        } catch (\Exception $e) {
            $this->entityManager->getConnection()->rollBack();
            throw $e;
        }
    }
}