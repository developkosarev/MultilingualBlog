<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\PostRepository;

/**
 * @Route({
 *   "en": "/blog" ,
 *   "de": "/blog"
 *     })
 * @IsGranted("ROLE_USER")
 */
class PostController extends AbstractController
{
    /**
     * @Route("/", methods="GET", name="blog_index")
     * @param Request $request
     * @param PostRepository $posts
     * @return Response
     */
    public function index(Request $request, PostRepository $posts): Response
    {
        $postItems = $posts->findLatest();

        return $this->render('post/index.html.twig', ['postItems' => $postItems]);
    }

    /**
     * @Route("/post/{slug}", methods="GET", name="blog_show")
     * @param $slug
     * @param PostRepository $posts
     * @return Response
     */
    public function show($slug, PostRepository $posts): Response
    {
        $post = $posts->findOneBySlug($slug);

        if (!$post) {
            throw $this->createNotFoundException('The post does not exist');
        }

        return $this->render('post/show.html.twig', ['post' => $post]);
    }
}
