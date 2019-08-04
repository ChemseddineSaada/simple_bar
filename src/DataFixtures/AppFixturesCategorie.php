<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\categorie;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixturesCategorie extends Fixture
    {
        public function load(ObjectManager $manager)
            {
                // catégories principales
                $categoriesSpecials = ['houblon', 'rose', 'menthe', 'grenadine', 'réglisse', 'marron', 'whisky', 'bio'] ;
                // catégories normales
                $categoryNormales = ['blonde', 'brune', 'blanche'] ;

                for($i=0;$i<count($categoryNormales);$i++){

                    $categorie = new categorie();
                    $categorie->setTitle($categoryNormales[$i]);                  
                    $categorie->setTerm('normale');


                    $manager->persist($categorie);
                    $manager->flush();
                    
                }

                return $categorie;
                
            }
    }
