<?php

namespace App\DataFixtures;

use App\Entity\Doc\Invoice\Invoice;
use App\Entity\Doc\Invoice\InvoiceProduct;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class InvoiceFixtures extends Fixture implements DependentFixtureInterface
{
    public const INVOICE1_REFERENCE = 'Invoice-1';
    public const INVOICE2_REFERENCE = 'Invoice-2';

    public function load(ObjectManager $manager)
    {
        //1
        $invoice = new Invoice();
        //$invoice->setId(1);

        $invoiceProduct = new InvoiceProduct();
        $invoiceProduct->setProduct($this->getReference(ProductFixtures::PRODUCT1_REFERENCE));
        $invoiceProduct->setQuantity(1);
        $invoiceProduct->setPrice(10);

        $invoice->addInvoiceProducts($invoiceProduct);

        $invoiceProduct = new InvoiceProduct();
        $invoiceProduct->setProduct($this->getReference(ProductFixtures::PRODUCT2_REFERENCE));
        $invoiceProduct->setQuantity(2);
        $invoiceProduct->setPrice(20);

        $invoice->addInvoiceProducts($invoiceProduct);

        $this->addReference(self::INVOICE1_REFERENCE, $invoice);
        $manager->persist($invoice);


        //2
        $invoice = new Invoice();
        //$invoice->setId(2);

        $invoiceProduct = new InvoiceProduct();
        $invoiceProduct->setProduct($this->getReference(ProductFixtures::PRODUCT1_REFERENCE));
        $invoiceProduct->setQuantity(1);
        $invoiceProduct->setPrice(10);

        $invoice->addInvoiceProducts($invoiceProduct);

        $invoiceProduct = new InvoiceProduct();
        $invoiceProduct->setProduct($this->getReference(ProductFixtures::PRODUCT2_REFERENCE));
        $invoiceProduct->setQuantity(2);
        $invoiceProduct->setPrice(20);

        $invoice->addInvoiceProducts($invoiceProduct);

        $this->addReference(self::INVOICE2_REFERENCE, $invoice);
        $manager->persist($invoice);

        for ($i = 1; $i <= 20; $i++) {
            $invoice = new Invoice();

            $invoiceProduct = new InvoiceProduct();
            $invoiceProduct->setProduct($this->getReference(ProductFixtures::PRODUCT1_REFERENCE));
            $invoiceProduct->setQuantity(1);
            $invoiceProduct->setPrice(10);

            $invoice->addInvoiceProducts($invoiceProduct);

            $invoiceProduct = new InvoiceProduct();
            $invoiceProduct->setProduct($this->getReference(ProductFixtures::PRODUCT2_REFERENCE));
            $invoiceProduct->setQuantity(2);
            $invoiceProduct->setPrice(20);

            $invoice->addInvoiceProducts($invoiceProduct);

            $manager->persist($invoice);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            UserFixtures::class,
            ProductFixtures::class,
            WarehouseFixtures::class
        );
    }
}
