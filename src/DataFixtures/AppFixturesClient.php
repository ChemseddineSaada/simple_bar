<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Client;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Controller\BarController;

class AppFixturesClient extends Fixture
    {
        public function load(ObjectManager $manager)
            {
                $faker = Faker\Factory::create('fr_FR');

                $client = new Client();

                $client->setName($faker->name);
                $client->setWeight($faker->randomFloat($nbMaxDecimals = 1, $min = 50, $max = 100));
                $client->setEmail($faker->email);

                
                $manager->persist($client);
                $manager->flush();

                return $client;
            }
    }