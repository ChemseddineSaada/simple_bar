<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Country;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixturesCountry extends Fixture
    {
        public function load(ObjectManager $manager)
            {
                $countries = ['Belgium', 'French', 'English', 'German'];
                $faker = Faker\Factory::create('fr_FR');

                for($i=0;$i<count($countries);$i++){

                    $country = new Country();
                    $country->setName($countries[$i]);
                    $country->setAddress($faker->address);
                    $country->setEmail($faker->email);

                    $manager->persist($country);
                    $manager->flush();
                    
                }

                return $country;
                
            }
    }
