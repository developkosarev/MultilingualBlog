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

    /**
     * @Route("/adminvuetify", name="admin_vuetify")
     * @Route("/adminvuetify/{vueRouting}", name="admin_vuetify_vue")
     */
    public function indexVuetify()
    {
        return $this->render('admin/index_vuetify.html.twig');
    }
}
