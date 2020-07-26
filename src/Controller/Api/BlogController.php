<?php

namespace App\Controller\Api;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMException;
use Exception;

use App\Entity\Post;
use App\Repository\PostRepository;
use App\Service\TranslationService;

/**
 * @Route("/api/blog")
 */
class BlogController extends AbstractController
{
    private $repository;
    private $serializer;
    private $translationService;
    private $entityManager;
    public function __construct(PostRepository $postRepository, SerializerInterface $serializer, EntityManagerInterface $entityManager, TranslationService $translationService)
    {
        $this->repository = $postRepository;
        $this->serializer = $serializer;
        $this->translationService = $translationService;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route(path="/", methods={"GET"}, name="api_blog_index")
     * IsGranted({"ROLE_USER, ROLE_MANAGER", "ROLE_ADMIN"})
     */
    public function index(): JsonResponse
    {
        $posts = $this->repository->findLatest();
        $data = $this->serializer->serialize(
            $posts,
            'json',
            ['groups' => ['post:id', 'post:default']]
        );

        return new JsonResponse($data, JsonResponse::HTTP_OK, [], true);
    }

    /**
     * @Route(path="/id/{post}", methods={"GET"}, name="api_blog_get")
     * IsGranted({"ROLE_USER, ROLE_MANAGER", "ROLE_ADMIN"})
     */
    public function getId(Post $post): JsonResponse
    {
        $data = $this->serializer->serialize($post, 'json', ['groups' => ['post:id', 'post:default']]);

        return new JsonResponse($data, JsonResponse::HTTP_OK, [], true);
    }

    /**
     * @Route(path="/{slug}", methods={"GET"}, name="api_blog_getslug")
     * @Entity("post", expr="repository.findOneBySlag(slug)")
     * IsGranted({"ROLE_USER, ROLE_MANAGER", "ROLE_ADMIN"})
     */
    public function getSlug(Post $post): JsonResponse
    {
        $data = $this->serializer->serialize($post, 'json', ['groups' => ['post:id', 'post:default']]);

        return new JsonResponse($data, JsonResponse::HTTP_OK, [], true);
    }

    /**
     * @Route(path="/create", methods={"POST"}, name="api_blog_create")
     * IsGranted({"ROLE_MANAGER", "ROLE_ADMIN"})
     */
    public function create(Request $request): JsonResponse
    {
        $post = new Post();

        $post->setAuthor($this->getUser());

        $authorEmail = $request->request->get('authorEmail');
        $post->setAuthorEmail($authorEmail);

        $post = $this->translationService->translateEntity($request, $post);

        $this->entityManager->persist($post);
        $this->entityManager->flush();
        $data = $this->serializer->serialize($post, 'json', ['groups' => ['post:id', 'post:default']]);

        return new JsonResponse($data, JsonResponse::HTTP_OK, [], true);
    }

    /**
     * @Route(path="/{post}", methods={"PUT"}, name="api_blog_update")
     * IsGranted({"ROLE_MANAGER", "ROLE_ADMIN"})
     *
     * @throws ORMException
     * @throws Exception
     */
    public function update(Request $request, Post $post): JsonResponse
    {
        $authorEmail = $request->request->get('authorEmail');
        $post->setAuthorEmail($authorEmail);

        $this->entityManager->flush();
        $post = $this->translationService->translateEntity($request, $post);

        $this->entityManager->persist($post);
        $this->entityManager->flush();

        $data = $this->serializer->serialize($post, 'json', ['groups' => ['post:id', 'post:default']]);
        return new JsonResponse($data, JsonResponse::HTTP_OK, [], true);
    }

    /**
     * @Route(path="/{post}", methods={"DELETE"}, name="api_blog_delete")
     * IsGranted({"ROLE_MANAGER", "ROLE_ADMIN"})
     *
     * @throws ORMException
     */
    public function delete(Post $post): JsonResponse
    {
        $this->entityManager->remove($post);
        $this->entityManager->flush();

        return new JsonResponse([], JsonResponse::HTTP_NO_CONTENT);
    }
}
