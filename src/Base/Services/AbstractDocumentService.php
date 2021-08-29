<?php

namespace App\Base\Services;

use App\Base\Interfaces\DocumentInterface;
use App\Base\Interfaces\DocumentRepositoryInterface;
use App\Base\Interfaces\DocumentServiceInterface;

abstract class AbstractDocumentService implements DocumentServiceInterface
{
    #region Fields

    protected $repository;

    #endregion

    #region Property

    public function getRepository(): DocumentRepositoryInterface
    {
        return $this->repository;
    }

    #endregion

    #region Methods

    public function get(int $id): ?DocumentInterface
    {
        return $this->repository->getById($id);
    }

    public function add(DocumentInterface $document): DocumentInterface
    {
        return $this->repository->add($document);
    }

    public function delete(DocumentInterface $document): void
    {
        // TODO: Implement delete() method.
    }

    public function save(): void
    {
        $this->repository->save();
    }

    #endregion
}
