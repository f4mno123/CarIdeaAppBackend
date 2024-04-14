<?php

namespace App\Controller;

use App\Entity\SellingItem;
use App\Repository\SellingItemRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


class SellingItemController extends AbstractController
{
    public function __construct(
        private readonly SellingItemRepository $sellingItemRepository
    )
    {
    }


    #[Route(path: '/api/selling-items', methods: [Request::METHOD_GET])]
    public function getAllSellingItems(Request $request): JsonResponse
    {
        $page = $request->query->getInt('page', 1);
        $limit = $request->query->getInt('limit', 40);

        $offset = ($page - 1) * $limit;

        $sellingItems = $this->sellingItemRepository->findBy([], null, $limit, $offset);

        return $this->json($sellingItems, context: ['groups' => 'selling_item']);
    }

    #[Route(path: '/api/selling-items', methods: Request::METHOD_POST)]
    public function createSellingItem(Request $request, EntityManagerInterface $entityManager): Response
    {

        $itemName = $request->getPayload()->get('itemName');
        $price = $request->getPayload()->get('price');
        $itemDescription = $request->getPayload()->get('itemDescription');
        $imageLinkBlob = $request->getPayload()->get('imageLinkBlob');

        $sellingItem = new SellingItem();
        $sellingItem->setItemName($itemName);
        $sellingItem->setPrice($price);
        $sellingItem->setItemDescription($itemDescription);
        $sellingItem->setImageLinkBlob($imageLinkBlob);
        $entityManager->persist($sellingItem);
        $entityManager->flush();
        return new Response(null, Response::HTTP_CREATED);
    }

    #[Route(path: '/api/selling-items/{id}', methods: Request::METHOD_GET)]
    public function getSellingItem(int $id): JsonResponse
    {
        $sellingItem = $this->sellingItemRepository->find($id);
        if ($sellingItem === null) {
            return new JsonResponse(null, Response::HTTP_NOT_FOUND);
        }
        return $this->json($sellingItem);
    }
}

