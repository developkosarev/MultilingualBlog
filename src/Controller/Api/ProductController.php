<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ProductRepository;
use App\Service\TranslationService;

/**
 * @Route("/api/product")
 */
class ProductController extends AbstractController
{
    private $repository;
    private $serializer;
    private $translationService;
    private $entityManager;
    public function __construct(ProductRepository $productRepository, SerializerInterface $serializer, EntityManagerInterface $entityManager, TranslationService $translationService)
    {
        $this->repository = $productRepository;
        $this->serializer = $serializer;
        $this->translationService = $translationService;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route(path="/", defaults={"page": "1", "size":"25"}, methods={"GET"}, name="api_products_index")
     * @Route(path="/page/{page<[1-9]\d*>}", methods="GET", name="api_products_index_paginated")
     * @Route(path="/page/{page<[1-9]\d*>}/size/{size<[1-9]\d*>}", methods="GET", name="api_products_index_paginated_size")
     * IsGranted({"ROLE_USER, ROLE_MANAGER", "ROLE_ADMIN"})
     * @param int $page
     * @param int $size
     * @return JsonResponse
     */
    public function index1(int $page = 1, int $size = 25): JsonResponse
    {
        $products = $this->repository->findLatest($page, $size);
        $data = $this->serializer->serialize(
            $products,
            'json',
            ['groups' => ['ref:default', 'ref:id', 'ref:name']]
        );

        return new JsonResponse($data, JsonResponse::HTTP_OK, [], true);
    }
}
