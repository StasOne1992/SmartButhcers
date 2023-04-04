<?php

namespace App\Form;

use App\Entity\ProductionRecipeContent;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductionRecipeContentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('PostionArgument')
            ->add('PostionFormula')

            ->add('Nomenclature');
        if (true) {
            $builder->add('ProductionRecipeSection');
        } else {
            $builder->add('ProductionRecipeSection');
        };
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProductionRecipeContent::class,
        ]);
    }
}
