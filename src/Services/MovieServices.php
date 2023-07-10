<?php

namespace App\Services;

use App\Entity\Movie;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class MovieServices
{
   /* private EntityManagerInterface $em;
    private EntityRepository $repository;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->repository = $em->getRepository(Movie::class);
    }*/

    /**
     * @param $data
     * @return bool|string
     */
  /*  public function setMovie($data): ?bool
    {
        try {
            $movieEntity = new Movie();
            $movieData = $movieEntity->setDescription($data->description)
                ->setImagePath($data->imagePath)
                ->setTitle($data->releaseYear)
                ->setTitle($data->title);
            $this->em->persist($movieData);
            $this->em->flush();
        } catch (\Exception $e) {
            echo $e->getFile() . $e->getMessage() . $e->getLine();
        }
        return true;
    }*/

}