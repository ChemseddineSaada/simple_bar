<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\beer;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Controller\BarController;

class AppFixtures extends Fixture
    {
        public function load(ObjectManager $manager)
            {
                $faker = Faker\Factory::create('fr_FR');

                $beer = new beer();
                $beer->setTitle($faker->name);
                $beer->setDescription($faker->text);
                $beer->setPublishedAt($faker->dateTime('now'));
                $beer->setPrice($faker->randomFloat($nbMaxDecimals = 2, $min = 5, $max = 30));

                
                $manager->persist($beer);
                $manager->flush();

                return $beer;
            }
    }