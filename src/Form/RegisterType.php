<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Validator\Constraints\Length;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'Nom',
                'constraints' => new Length([
                    'min' => 2,
                    'max' => 30,
                ]),
                'attr' => [
                    'placeholder' => 'Veuillez entrer votre nom'
                ]
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Prenom',
                'constraints' => new Length([
                'min' => 2,
                'max' => 30,
                ]),
                'attr' => [
                    'placeholder' => 'Veuillez entrer votre prenom'
                    ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'attr' => [
                    'placeholder' => 'Veuillez entrer votre email'
                    ]
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Le mot de passe et la confirmation doivent être identique.',
                'required' => true,
                'first_options' => ['label' => 'Mot de Passe', 'attr' => ['placeholder' => 'Veuillez entrer votre mot de passe']],
                'second_options' => ['label' => 'Confirmer votre mot de Passe', 'attr' => ['placeholder' => 'Veuillez resaisir votre mot de passe']],
                
            ])
            
            ->add('type', ChoiceType::class, [
                'choices'  => [
                'Un Client' => 'customer',
                'Un Revendeurs' => 'reseller',
                'Un Distributeur' => 'distributor',
                ],
                'label' => 'Vous êtes',
            ])
            ->add('latitude', HiddenType::class)
            ->add('longitude', HiddenType::class)
            ->add('country', HiddenType::class)
            ->add('state', HiddenType::class)
            ->add('city', HiddenType::class)
            ->add('adress_ip', HiddenType::class)

            ->add('submit', SubmitType::class,[
                'label' => "S'inscrire"
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
