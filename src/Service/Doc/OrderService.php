<?php

namespace App\Service\Doc;

use App\Base\Services\AbstractDocumentService;
use App\Repository\Doc\OrderRepository;

class OrderService extends AbstractDocumentService
{
    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
    }
}
