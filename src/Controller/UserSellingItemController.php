<?php

namespace App\Controller;

use App\Entity\UserSellingItem;
use App\Repository\SellingItemRepository;
use App\Repository\UserSellingItemRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UserSellingItemController extends AbstractController
{
    public function __construct(
        private readonly SellingItemRepository $sellingItemRepository,
        private readonly UserSellingItemRepository $userSellingItemRepository
    )
    {
    }

    #[Route(path: '/api/user-selling-items', methods: [Request::METHOD_GET])]
    public function getUserSellingItems(Request $request): JsonResponse
    {
        $userSellingItems = $this->userSellingItemRepository->findBy([
            'user' => $this->getUser()
        ]);

        return $this->json($userSellingItems, context: [
            'groups' => 'selling_item'
        ]);
    }

    #[Route(path: '/api/user-selling-items', methods: Request::METHOD_POST)]
    public function createUserSellingItem(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $sellingItemId = $request->getPayload()->get('sellingItemId');
        $sellingItem = $this->sellingItemRepository->findBy([
            'id' => $sellingItemId
        ]);
        if ($sellingItem === null) {
            return new JsonResponse(['message' => 'Selling item not found'], Response::HTTP_NOT_FOUND);
        }

        $sellingItem = $this->sellingItemRepository->findOneBy(['id' => $sellingItemId
        ]);

        if ($sellingItem === null) {
            return new JsonResponse(['message' => 'Selling item not found'], Response::HTTP_NOT_FOUND);
        }

        $userSellingItem = $this->userSellingItemRepository->findOneBy([
            'user' => $this->getUser(),
            'sellingItem' => $sellingItem
        ]);

        if ($userSellingItem !== null) {
            return new JsonResponse(['message' => 'User already has this selling item'], Response::HTTP_BAD_REQUEST);
        }

        $userSellingItem = new UserSellingItem();
        $userSellingItem->setUser($this->getUser());
        $userSellingItem->setSellingItem($sellingItem);
        $entityManager->persist($userSellingItem);
        $entityManager->flush();
        return new JsonResponse(null, Response::HTTP_CREATED);
    }
}
