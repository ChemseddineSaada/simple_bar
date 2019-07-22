<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BarController
    {

    /**
    * @Route("/", name="home")
    */

    public function index()
        {
        return new Response('Hello Bar Controller');
        }

    /**
    * @Route("/beer/{slug}", name="show_beer")
    */

    public function contact($slug)
        {
            return new Response("Hello beer show $slug");
        }
    }
