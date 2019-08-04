<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\BeerType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\beer;
use Symfony\Component\Validator\Constraints\DateTime;
use Knp\Component\Pager\PaginatorInterface;

/**
* @Route("/admin")
*/

class BeerController extends AbstractController
{
    public function __construct(){
        
    }
    /**
    * @Route("/beer", name="admin.beer.index")
    */
    public function index(Request $request, PaginatorInterface $paginator)
    {
        $repoBeer = $this->getDoctrine()->getRepository(beer::class);

        // création d'un Query Builder une requête SQL personnalisée
        $query = $repoBeer->createQueryBuilder('b')->getQuery();

        $pagination = $paginator->paginate($query,$request->query->getInt('page', 1),12);

        // Configuration supplémentaire de la vue
        // twitter_bootstrap_v4_pagination
        $pagination->setCustomParameters(array(
            'align' => 'center', // css
            'size' => 'small',
            'style' => 'bottom',
            'span_class' => 'whatever'
            ));

        return $this->render('beer/index.html.twig', [
        'pagination' => $pagination,
        ]);
        }

    /**
    * @Route("/beer/create", name="admin.beer.create", methods={"GET", "POST"})
    */

    public function createBeer(Request $request){

        // ... création du formulaire
        $beer = new beer();

        $form = $this->createForm(BeerType::class, $beer);

        // récupère la Request avec les données du form
        $form->handleRequest($request);

        // Si le formulaire a été envoyé et est valide
        if($form->isSubmitted() && $form->isValid()){

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($form->getData());
            $manager->flush();

            $this->addFlash(
                'notice',
                'Beer added with succes !'
                );

            // redirection vers la page index en accord avec
            // les routes de votre projet
            
            return $this->redirectToRoute('admin.beer.index');
        }

        return $this->render('beer/create.html.twig', [
        'form' => $form->createView()
        ]);
    }

    /**
    * @Route("/beer/update/{id}", name="admin.beer.update")
    */

    public function update(Request $request, beer $beer){
    
        
    $form = $this->createForm(BeerType::class, $beer);

    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid()){

        $manager = $this->getDoctrine()->getManager();
        $manager->flush();

        $this->addFlash(
            'notice',
            'Beer updated with succes !'
            );
        
        return $this->redirectToRoute('admin.beer.index');
    }

    return $this->render('beer/create.html.twig', [
    'form' => $form->createView()
    ]);
    }

    /**
    * @Route("/beer/delete/{id}", name="admin.beer.delete")
    */
    
    public function delete(beer $beer){
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($beer);
        $manager->flush();
        $this->addFlash(
            'notice',
            'Beer deleted with succes !'
            );

        return $this->redirectToRoute('admin.beer.index');

    }
}