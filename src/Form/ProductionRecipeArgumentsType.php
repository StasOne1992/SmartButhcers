<?php

namespace App\Form;

use App\Entity\ProductionRecipeArguments;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductionRecipeArgumentsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Name')
            ->add('RecipeArgumentGUID')
            ->add('RecipeArgumentID')
            ->add('RecipeID')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProductionRecipeArguments::class,
        ]);
    }
}
