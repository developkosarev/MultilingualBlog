<?php

declare(strict_types=1);

namespace App\Repository\Doc;

use App\Entity\Base\BaseDoc;
use App\Base\Repository\BaseDocRepository;
use App\Entity\Doc\Invoice\Invoice;
use Doctrine\Common\Persistence\ManagerRegistry;

class InvoiceRepository extends BaseDocRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Invoice::class);
    }
}
