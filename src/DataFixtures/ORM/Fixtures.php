<?php

namespace App\DataFixtures\ORM;

use App\Entity\Author;
use App\Entity\BlogPost;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class Fixtures extends Fixture
{
    public function load(ObjectManager|\Doctrine\Persistence\ObjectManager $manager): void
    {
        $author = new Author();
        $author
            ->setName('Rostislav')
            ->setTitle('Developer')
            ->setUsername('auth0-username')
            ->setCompany('Company')
            ->setShortBio('Здесь описание автора.')
            ->setPhone('070000000')
            ->setFacebook('rosblog')
            ->setTwitter('rosblog.rosblog')
            ->setGithub('rosblog-bloggs');

        $manager->persist($author);

        $blogPost = new BlogPost();
        $blogPost
            ->setTitle('Ваш первый пост пример')
            ->setSlug('first-post')
            ->setDescription('Тут описание краткое')
            ->setBody('Тут полноценный пост Тут полноценный пост Тут полноценный пост Тут полноценный пост Тут полноценный пост Тут полноценный пост')
            ->setAuthor($author);
        $manager->persist($blogPost);
        $manager->flush();
    }
}