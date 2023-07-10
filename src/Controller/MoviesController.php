<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Form\MovieFormType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function create(Request $request): Response
    {
        $form = $this->createForm(MovieFormType::class, new Movie());
        if ($form->handleRequest($request)) {
            if ($form->isSubmitted() && $form->isValid()) {
                $data = $form->getData();
                $movieEntity = new Movie();
                $movieData = $movieEntity->setDescription($data->description)
                    ->setImagePath($data->imagePath)
                    ->setReleaseYear($data->releaseYear)
                    ->setTitle($data->title);
                $this->em->persist($movieData);
                $this->em->flush();
                $repository = $this->em->getRepository(Movie::class);
                return $this->render('movies/index.html.twig', ['movies' => $repository->findAll()]);
            }
        }
        return $this->render('movies/create.html.twig', ['form' => $form->createView()]);
    }
}
