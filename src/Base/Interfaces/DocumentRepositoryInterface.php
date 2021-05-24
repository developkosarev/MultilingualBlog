<?php

namespace App\Base\Interfaces;

interface DocumentRepositoryInterface
{
    public function getById(int $id): ?DocumentInterface;

    public function save(DocumentInterface $document): DocumentInterface;

    public function delete(DocumentInterface $document): void;
}
