<?php

namespace App\Controller;

use App\Base\RepositoryFactory\CustomRepositoryFactory;
use App\Base\Services\CodeGeneratorDefault;
use App\Entity\Doc\Invoice\Invoice;
use App\Service\Doc\InvoiceService;
use Doctrine\ORM\Repository\RepositoryFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    private $factory = null;

    //public function __construct(RepositoryFactory $factory)
    //{
    //    $this->factory = $factory;
    //}

    /**
     * @Route("/", name="default")
     */
    public function index()
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route({
     *   "en": "/contact" ,
     *   "de": "/kontakt"
*    * }, name="contact")
     */
    public function contact()
    {
        return $this->render('default/contact.html.twig');
    }

    /**
     * @Route({
     *   "en": "/test" ,
     *   "de": "/test"
     * }, name="test")
     */
    public function test(CustomRepositoryFactory $ref)
    {
        $this->factory = $ref;

        //Symfony\Component\DependencyInjection\ServiceLocator
        //$referralService = $this->get('doctrine.orm.container_repository_factory');
        //$referralService = $this->get('doctrine.orm.custom_repository_factory');

        $repository = $this->getDoctrine()->getRepository(Invoice::class);

        return $this->render(
            'default/test.html.twig',
            [
                'factory' => $this->factory
            ]
        );
    }

    /**
     * @Route({
     *   "en": "/test-invoice" ,
     *   "de": "/test-invoice"
     * }, name="test-invoice")
     */
    public function testInvoice(InvoiceService $invoiceService)
    {
        $invoice = $invoiceService->get(131);

        return $this->render(
            'default/test-invoice.html.twig',
            [
                'invoice' => $invoice
            ]
        );
    }
}
