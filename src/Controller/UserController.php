<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

final class UserController extends AbstractController
{
    #[Route("/user/create", name: "user_create")]
    public function create(Request $request, ManagerRegistry $doctrine, UserPasswordHasherInterface $userPassword): Response
    {
        $user = new User($userPassword); // Article vide
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request); // L'objet 'user' est hydraté
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager();
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute("home");
        }
        return $this->render("user/form.html.twig", ["form" => $form->createView()]);
    }
}
