<?php

namespace App\Base\Interfaces;

interface DocumentServiceInterface
{
    public function get(int $id): ?DocumentInterface;

    public function save(DocumentInterface $document): DocumentInterface;

    public function delete(DocumentInterface $document): void;
}