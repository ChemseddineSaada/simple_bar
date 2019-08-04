<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use App\Entity\BeerUser;


class BeerUserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $beeruser = new BeerUser();
    
        $manager->persist($beeruser);
        $manager->flush();

        return $beeruser;
    }
}
