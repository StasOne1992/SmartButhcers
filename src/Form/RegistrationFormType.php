<?php

namespace App\Form;

use App\Entity\User;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email',EmailType::class,[ 'attr' =>   [ 'class' => 'intro-x login__input form-control py-3 px-4 pb-4 block','placeholder'=>'Email'] , 'label' => false  ])
            ->add('lastname',TextType::class,[ 'attr' =>   [ 'class' => 'intro-x login__lastname form-control py-3 px-4 pb-4 block','placeholder'=>'Фамилия'] , 'label' => false  ])
            ->add('firstname',TextType::class,[ 'attr' =>   [ 'class' => 'intro-x login__firstname form-control py-3 px-4 pb-4 block','placeholder'=>'Имя'] , 'label' => false  ])

            ->add('middlename',TextType::class,[ 'attr' =>   [ 'class' => 'intro-x login__middlename form-control py-3 px-4 pb-4 block','placeholder'=>'Отчество'] , 'label' => false  ])

            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => [
                    'autocomplete' => 'new-password',
                    'class' => 'intro-x login__input form-control py-3 px-4 pt-4 block','placeholder'=>'Password'
                    ],
                'label'=>false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])

            ->add('agreeTerms', CheckboxType::class, [
                'attr' => ['class'=>'form-check-input border mr-2'],
                'label'=>'Согласен с условиями',
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Вы должны согласиться с условиями использования сервисов.',
                    ]),
                ],
            ])

            ->add('Submit', SubmitType::class,
                [
                    'label'=>'Зарегистрировать',
                'attr'=> ['class'=>'btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top','type'=>'submit']
            ])


        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
