<?php

namespace App\DataFixtures;

use App\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\DBAL\Driver\IBMDB2\Exception\Factory;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as FakerFactory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {   
        $faker = FakerFactory::create('fr_FR');

        for ($i = 0; $i < 10; $i++) {
            $book = new Book();
            $book->setISBN($faker->regexify('[A-Z]{5}[0-4]{3}'));
            $book->setTitre($faker->sentence(3));
            $book->setResumer($faker->sentence(10));
            $book->setDescription($faker->paragraph(2));
            $book->setPrix($faker->randomNumber(2));
            $manager->persist($book);
        }
    

        $manager->flush();
    }
}
