<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class AuthController extends AbstractController
{
    #[Route(path: '/api/register', methods: Request::METHOD_POST)]
    public function register(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(UserForm::class, $user);
        $form->submit($request->toArray());
        if (!$form->isValid()) {
            return new Response("invalid request", Response::HTTP_BAD_REQUEST);
        }
        $hashedPassword = $passwordHasher->hashPassword(
            $user,
            $user->getPassword(),
        );
        $user->setPassword($hashedPassword);
        $user->onPrePersist();
        $entityManager->persist($user);
        $entityManager->flush();

        return new Response(null,Response::HTTP_CREATED);
    }
    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

}
