<?php

namespace App\Controller;

use App\Entity\Movie;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MoviesController extends AbstractController
{
    private EntityManagerInterface $em;
    public function __construct(EntityManagerInterface $em) 
    {
        $this->em = $em;
    }

    #[Route('/', name: 'movies')]
    public function index(): Response
    {
        $repository = $this->em->getRepository(Movie::class);
        $movies = $repository->findAll();
        return $this->render('movies/index.html.twig', ['movies' => $movies]);
    }

    #[Route('movies/create', name: 'moviesCreate')]
    public function create(): Response
    {
        $repository = $this->em->getRepository(Movie::class);
        $movies = $repository->findAll();
        return $this->render('movies/create.html.twig', ['movies' => $movies]);
    }
} 
