<?php

namespace App\Controller;

use App\Repository\BlogRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
   public function index(BlogRepository $blogRepository): Response
    {
        $blog = $blogRepository->find(1);


        return $this->render('blog/blog.html.twig', [
            'blog' => $blog,
        ]);
    }
}