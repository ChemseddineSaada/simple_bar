<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;
use Faker;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        $user = new User();

        $user->setName($faker->name);
        $user->setEmail($faker->email);
        
        
        $manager->persist($user);
        $manager->flush();

        return $user;
    }
}
