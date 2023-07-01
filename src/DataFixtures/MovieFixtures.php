<?php

namespace App\DataFixtures;

use App\Entity\Movie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MovieFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $movie = new Movie();
        $movie->setTitle('Темный рыцарь');
        $movie->setReleaseYear(2008);
        $movie->setDescription('Это описание для Темного рыцаря');
        $movie->setImagePath('https://c.wallhere.com/photos/36/4b/Batman_The_Dark_Knight_movies-205234.jpg!d');
        
        //Add Data To Pivot Table
        $movie->addActor($this->getReference('actor_1'));
        $movie->addActor($this->getReference('actor_2'));

        $manager->persist($movie);

        $movie2 = new Movie();
        $movie2->setTitle('Мстители:Финал');
        $movie2->setReleaseYear(2019);
        $movie2->setDescription('Это описание для Мстители:Финал');
        $movie2->setImagePath('https://i.playground.ru/p/a8AnsnZ0FQl9KdoH55qqnw.jpeg');

        //Add Data To Pivot Table
        $movie2->addActor($this->getReference('actor_3'));
        $movie2->addActor($this->getReference('actor_4'));

        $manager->persist($movie2);

        $manager->flush();
    }
}
