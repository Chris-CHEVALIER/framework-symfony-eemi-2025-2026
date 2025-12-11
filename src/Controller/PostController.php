<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use DateTime;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PostController extends AbstractController
{
    #[Route("/post/create", name: "post_create")]
    public function create(Request $request, ManagerRegistry $doctrine): Response
    {
        $post = new Post(); // Article vide
        $form = $this->createForm(PostType::class, $post);

        $form->handleRequest($request); // L'objet 'post' est hydraté
        if ($form->isSubmitted() && $form->isValid()) {
            $post->setPublishedAt(new DateTime());
            $em = $doctrine->getManager();
            $em->persist($post);
            $em->flush();
            return $this->redirectToRoute("home");
        }
        return $this->render("post/form.html.twig", ["form" => $form->createView()]);
    }

    #[Route("/post/edit/{id}", name: "post_edit")]
    public function edit(Request $request, ManagerRegistry $doctrine, Post $post): Response
    {
        $form = $this->createForm(PostType::class, $post);

        $form->handleRequest($request); // L'objet 'post' est réhydraté
        if ($form->isSubmitted() && $form->isValid()) {
            /* $post->setPublishedAt(new DateTime()); */
            $em = $doctrine->getManager();
            $em->flush();
            return $this->redirectToRoute("home");
        }
        return $this->render("post/form.html.twig", ["form" => $form->createView()]);
    }

    #[Route("/", name: "home")]
    public function readAll(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Post::class);
        return $this->render("post/home.html.twig", ["posts" => $repository->findAll()]);
    }

    #[Route("post/read/{id}", name: "read_post")]
    public function read(Post $post): Response
    {
        return $this->render("post/read.html.twig", ["post" => $post]);
    }

    #[Route("post/delete/{id}", name: "delete_post")]
    public function delete(ManagerRegistry $doctrine, Post $post): Response
    {
        $em = $doctrine->getManager();
        $em->remove($post);
        $em->flush();
        return $this->redirectToRoute("home");
    }
}
