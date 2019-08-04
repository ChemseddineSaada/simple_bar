<?php

namespace App\Form;

use App\Entity\{beer,categorie, Country};
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\Extension\Core\Type\DateType;


class BeerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('published_at', DateType::class, array(
                'format' => 'yyyy-MM-dd', 
            ))
            ->add('Price')

            ->add('categorie', EntityType::class, [
                'class' => categorie::class,
                'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('cat')
                ->orderBy('cat.title', 'ASC');
                },
                'choice_label' => 'title',
                'multiple' => true, // choix multiple
                'expanded' => true, // affichage en checkbox
                // ajoutez cette option pour sauvegarder les catégories
                'by_reference' => false,
                ])
                
            ->add('country_id', EntityType::class, [
                'class' => Country::class,
                'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('coun')
                ->orderBy('coun.name', 'ASC');
                },
                'choice_label' => 'name',
                'multiple' => false, // choix multiple
                'expanded' => false, // affichage en checkbox
                // ajoutez cette option pour sauvegarder les catégories
                'by_reference' => true,
                ])

            //->add('client')
            //->add('beer')
            //->add('clientNew')
            ->add('save', SubmitType::class, ['label' => 'Save'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => beer::class,
        ]);
    }
}
