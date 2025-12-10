<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PostController extends AbstractController
{
    #[Route("/post/create", name: "post_create")]
    public function create(Request $request): Response
    {
        $post = new Post(); // Article vide
        $form = $this->createForm(PostType::class, $post);

        $form->handleRequest($request); // L'objet 'post' est hydraté
        if ($form->isSubmitted() && $form->isValid()) {
            $post->setPublishedAt(new DateTime());
            dump($post);
        }
        return $this->render("post/form.html.twig", ["form" => $form->createView()]);
    }
}
