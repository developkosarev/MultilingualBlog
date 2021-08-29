<?php

namespace App\Service\Doc;

use App\Base\Services\AbstractDocumentService;
use App\Entity\Doc\Invoice\Invoice;
use App\Repository\Doc\InvoiceRepository;

class InvoiceService extends AbstractDocumentService
{
    public function __construct(InvoiceRepository $repository)
    {
        $this->repository = $repository;
    }

    public function addDocument(Invoice $invoice)
    {
        $invoice->setTotalSum(0);
        foreach ($invoice->getInvoiceProducts() as $item) {
            $invoice->setTotalSum($invoice->getTotalSum() + $item->getSum());
        }

        $this->add($invoice);
    }
}
