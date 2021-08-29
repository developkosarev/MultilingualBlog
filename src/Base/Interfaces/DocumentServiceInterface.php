<?php

namespace App\Base\Interfaces;

interface DocumentServiceInterface
{
    public function get(int $id): ?DocumentInterface;

    public function add(DocumentInterface $document): DocumentInterface;

    public function delete(DocumentInterface $document): void;

    public function save(): void;
}