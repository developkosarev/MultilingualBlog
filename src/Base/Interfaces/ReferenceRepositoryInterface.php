<?php

namespace App\Base\Interfaces;

interface ReferenceRepositoryInterface
{
    public function getById(int $id): ?ReferenceInterface;

    public function save(ReferenceInterface $reference): ReferenceInterface;

    public function delete(ReferenceInterface $reference): void;
}
