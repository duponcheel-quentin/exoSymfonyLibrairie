<?php

namespace App\Form;

use App\Entity\Library;
use App\Entity\Livres;
use App\Entity\Categories;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class LivresType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('author')
            ->add('resume')
            ->add('edition')
            ->add('date')
            ->add('status')
            ->add('library', EntityType::class, [
              'class'=>Library::class,
              'choice_label'=>'city'
            ])
            ->add('categories', EntityType::class, [
              'class'=>Categories::class,
              'choice_label'=>'name'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Livres::class,
        ]);
    }
}
