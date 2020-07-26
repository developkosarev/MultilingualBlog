<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

///**
// * @IsGranted({"ROLE_ADMIN", "ROLE_MANAGER"})
// */
class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     * @Route("/admin/{vueRouting}", name="admin_vue")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig');
    }
}
