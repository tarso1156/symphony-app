<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/posts", name="post.")
 */
class PostController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(PostRepository $postRepository): Response
    {
        $posts = $postRepository->findAll();

        return $this->render('post/index.html.twig', [
            "posts" => $posts
        ]);
    }

    /**
     * @Route("/store", name="store")
     * @param Request $request
     * @return Response
     */
    public function store(Request $request): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $post = new Post();
        $post->setTitle("Test");

        $entityManager->persist($post);
        $entityManager->flush();

        return new Response($post->getId());
    }

    /**
     * @Route("/show/{id}", name="show")
     * @return Response
     */
    public function show(Post $post): Response
    {
        return $this->render("post/show.html.twig", [
            "post" => $post
        ]);
    }
}
