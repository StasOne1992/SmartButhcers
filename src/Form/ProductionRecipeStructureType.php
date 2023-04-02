<?php

namespace App\Form;

use App\Entity\ProductionRecipeStructure;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductionRecipeStructureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('StructureName')
            ->add('StructureOrdering')
            ->add('ProductionRecipeID')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProductionRecipeStructure::class,
        ]);
    }
}
