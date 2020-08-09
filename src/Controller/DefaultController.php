<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
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
    public function test()
    {
        return $this->render('default/test.html.twig');
    }
}
