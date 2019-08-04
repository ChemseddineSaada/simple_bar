<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\DataFixtures\{AppFixtures,AppFixturesCountry,AppFixturesCategorie,AppFixturesClient,UserFixtures,BeerUserFixtures};
use Symfony\Component\HttpFoundation\Response;
use App\Entity\{beer,Country,categorie,Client,User,BeerUser};
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Faker;


class BarController extends AbstractController
{

    /**
     * @Route("/bar", name="bar")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Beer::class);
        $beers = $repository->findAll();
        $repository = $this->getDoctrine()->getRepository(Country::class);
        $countries = $repository->findAll();

        return $this->render('bar/index.html.twig', [
            'controller_name' => 'BarController',
            'title' => 'La page index des bières',
            'beers' => $beers,
            'countries' => $countries,
        ]);
    }

    /**
    * @Route("/beers/{slug}", name="show_beer")
    */

    public function show(string $slug){
        
        $repository = $this->getDoctrine()->getRepository(beer::class);
        $beers = $repository->findAll();

        return $this->render('bar/beer.html.twig', [
            'title' => 'Beers',
            'beers' => $beers[$slug],
        ]);
        }

    /**
    * @Route("/country/{slug}", name="show_country")
    */

    public function showCountry(string $slug){
        
        $repository = $this->getDoctrine()->getRepository(Country::class);
        $countries = $repository->findAll();

        return $this->render('bar/country.html.twig', [
            'title' => $countries[$slug]->getName(),
            'country' => $countries[$slug],
        ]);
        }


    /**
    * @Route("/newbeer", name="create_beer")
    */
    public function createBeer(ObjectManager $manager){
        
        $entityManager = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository(beer::class);
        $beers = $repository->findAll();
        $faker = Faker\Factory::create('fr_FR');

        foreach($beers as $beer){
            $beer->setDegree($faker->randomFloat($nbMaxDecimals = 1, $min = 1, $max = 37));
            $r=rand(0,3);
            $note = ['very good','good','not good','bad'];
            $beer->setNote($note[$r]);
            $manager->persist($beer);
            $manager->flush();
        }

        return new Response('Saved new beer with id '.$faker->randomFloat($nbMaxDecimals = 1, $min = 1, $max = 37));
        
        }
    


    /**
    * @Route("/newcountry", name="create_country")
    */
    public function createCountry(){

        $entityManager = $this->getDoctrine()->getManager();

        $AppFixturesCountry = new AppFixturesCountry;

        $country = $AppFixturesCountry->load($entityManager);

        return new Response('Saved new country with id '.$country->getId());
        
        }

    /**
    * @Route("/newcategorie", name="create_categorie")
    */
    public function createCategorie(){

        $entityManager = $this->getDoctrine()->getManager();

        $AppFixturesCategorie = new AppFixturesCategorie;

        $categorie = $AppFixturesCategorie->load($entityManager);

        return new Response('Saved new country with id '.$categorie->getId());
        
        }

    /**
    * @Route("/newclient", name="create_client")
    */
    public function createClient(){

        $entityManager = $this->getDoctrine()->getManager();

        $AppFixturesClient = new AppFixturesClient;

        $client = $AppFixturesClient->load($entityManager);

        return new Response('Saved new Client with id '.$client->getId());
        
        }

    /**
    * @Route("/newuser", name="create_user")
    */
    public function createUser(){

        $entityManager = $this->getDoctrine()->getManager();

        $UserFixtures = new UserFixtures;

        $user = $UserFixtures->load($entityManager);

        return new Response('Saved new Client with id '.$user->getId());
        
        }
    
    /**
    * @Route("/newbeeruser", name="create_beeruser")
    */
    public function createBeerUser(){

        $entityManager = $this->getDoctrine()->getManager();

        $BeerUserFixtures = new BeerUserFixtures;

        $beeruser = $BeerUserFixtures->load($entityManager);

        return new Response('Saved new Client with id '.$beeruser->getId());
        
        }

    /**
    * @Route("/beeruserfill", name="beer_user_fill")
    */
    public function beerUserFill(ObjectManager $manager){
        $repository = $this->getDoctrine()->getRepository(beer::class);
        $beers = $repository->findAll();

        $repository = $this->getDoctrine()->getRepository(User::class);
        $users = $repository->findAll();

        foreach($users as $user){
            $r=rand(1,30);
            $beeruser = new BeerUser();

            $beeruser->setBeerId($beers[$r]);
            $beeruser->setDegree($beers[$r]->getDegree());
            $beeruser->setNote($beers[$r]->getNote());
            $beeruser->setUserId($user);
            
            $manager->persist($beeruser);
            $manager->flush();
        }
        return new Response('BeerUser filled !');
    }
    /**
    * @Route("/clientfill", name="client_fill")
    */
    public function clientfill(ObjectManager $manager){

        $repository = $this->getDoctrine()->getRepository(beer::class);
        $beers = $repository->findAll();
        
        $repository = $this->getDoctrine()->getRepository(Client::class);
        $clients = $repository->findAll();

        foreach($clients as &$client){
            $r1 = rand(0,29);
            $r2 = rand(0,29);
            $r3 = rand(0,29);

            $client->addBeer($beers[$r1]);
            $client->addBeer($beers[$r2]);
            $client->addBeer($beers[$r3]);          
            
            $categories1 = $beers[$r1]->getCategorie();
            $categories2 = $beers[$r2]->getCategorie();
            $categories3 = $beers[$r3]->getCategorie(); 

            $client->addCategorie($categories1[0]);
            $client->addCategorie($categories2[0]);
            $client->addCategorie($categories3[0]);
        }

            $manager->persist($client);
            $manager->flush();
            return new Response('Saved new beer on country with id');
    }



    /**
    * @Route("/countryadder", name="country_adder")
    */
    public function countryAdder(ObjectManager $manager){

        $repository = $this->getDoctrine()->getRepository(beer::class);
        $beers = $repository->findAll();

        foreach($beers as &$beer){

            $repository = $this->getDoctrine()->getRepository(Country::class);
            $countries = $repository->findAll();

            $r=rand(0,3);
            $beer->setCountryId($countries[$r]);

            $manager->persist($beer);
            $manager->flush();

        }
        return new Response('Saved new beer with id '.$r);
    }

    /**
    * @Route("/beeradder", name="beer_adder")
    */
    public function beerAdder(ObjectManager $manager){

        $repository = $this->getDoctrine()->getRepository(beer::class);
        $beers = $repository->findAll();
        
        $repository = $this->getDoctrine()->getRepository(Country::class);
        $countries = $repository->findAll();

        foreach($countries as &$country){

            foreach($beers as $beer){
                if($country == $beer->getCountryId()){
                    $country->addBeersNew($beer);
                }
            }
        }

            $manager->persist($beer);
            $manager->flush();
            return new Response('Saved new beer on country with id');
    }


    /**
    * @Route("/beeradders", name="beer_adders")
    */
    public function beerAdders(ObjectManager $manager){

        $repository = $this->getDoctrine()->getRepository(beer::class);
        $beers = $repository->findAll();
        
        $repository = $this->getDoctrine()->getRepository(categorie::class);
        $categories = $repository->findAll();

            foreach($beers as $beer){
                $r=rand(0,10);
                $beer->addCategorie($categories[$r]);
            }
        

            $manager->persist($beer);
            $manager->flush();
            return new Response('Saved new beer on country with id');
    }


    /**
    * @Route("/menu", name="menu")
    */
    public function mainMenu(){

        $repository = $this->getDoctrine()->getRepository(Categorie::class);
        $categories = $repository->findByTerm('normale');

        return $this->render('bar/partials/menu.html.twig', ['categories' => $categories]);
    }

    /**
    * @Route("/categorie/{slug}", name="categorie")
    */
    public function categorieBeers($slug){

        $repository = $this->getDoctrine()->getRepository(Categorie::class);
        $categories = $repository->findByTerm('normale');
        

        $categorie = $categories[$slug];
        $beers = $categorie->getBeers();
        

        return $this->render('bar/categorie.html.twig', ['beers' => $beers,
                                                         'title' => 'Bière par catégorie !',
                                                         'categorie' => $categorie
                                                        ]);
    }

    /**
    * @Route("/statistic", name="statistic")
    */
    public function statistic(){

        $repository = $this->getDoctrine()->getRepository(Client::class);
        $clients = $repository->findAll();
        

        return $this->render('bar/statistic.html.twig', ['clients' => $clients,
                                                         'title' => 'Quelques statistiques !',
                                                        ]);
    }

    /**
    * @Route("/verygood", name="verygood")
    */
    public function verygood(){

        $repository = $this->getDoctrine()->getRepository(beer::class);
        $beers = $repository->findByNote('very good');
        

        return $this->render('bar/verygood.html.twig', ['beers' => $beers,
                                                         'title' => 'Beers with best rating',
                                                        ]);
    }

    /**
    * @Route("/bestbeer", name="bestbeer")
    */
    public function bestBeer(){

        $repository = $this->getDoctrine()->getRepository(beer::class);
        $beers = $repository->bestBeer();
        

        return $this->render('bar/bestbeer.html.twig', ['beer' => $beers[0],
                                                         'title' => 'The best Beer',
                                                        ]);
    }
}
