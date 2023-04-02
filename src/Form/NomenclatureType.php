<?php

namespace App\Form;

use App\Entity\ClassifierOKEI;
use App\Entity\Nomenclature;
use App\Entity\NomenclatureTypes;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;

class NomenclatureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('NomenclatureName', TextType::class, [ 'attr' =>   [ 'class' => ' form-control','placeholder'=>'Введите наименование'] , 'label' => 'Наименование'  ] )
            ->add('NomenclatureArticul', TextType::class, [ 'attr' =>   [ 'class' => 'form-control','placeholder'=>'Введите артикул'] , 'label' => 'Артикул' ])
            ->add('NomenclatureGUID', TextType::class, [ 'attr' =>   [ 'class' => 'form-control','placeholder'=>'Введите GUID для 1С',] , 'label' => 'GUID для 1С' ])
            ->add('NomenclatureTypes', EntityType::class,['class'=>NomenclatureTypes::class, 'attr' =>   [ 'class' => 'tom-select','placeholder'=>'Введите тип номенклатуры'] , 'label' => 'Тип номенклатуры' ])
            ->add('GenerateGUID', ButtonType::class, ['attr' => ['class' => 'btn btn-primary','onclick'=>'genPassword()'],'label'=>'Обновить'])
            ->add('Unit', EntityType::class,['class'=>ClassifierOKEI::class, 'attr' =>   [ 'class' => 'tom-select','placeholder'=>'Введите GUID для 1С'] , 'label' => 'Единица измерения' ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Nomenclature::class,
        ]);
    }
}
