<?php

namespace App\Form;

use App\Entity\ClassifierOKEI;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClassifierOKEIType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Name')
            ->add('ShortName')
            ->add('PositionKey')
            ->add('GroupID')
            ->add('GroupName')
            ->add('SectionName')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ClassifierOKEI::class,
        ]);
    }
}
