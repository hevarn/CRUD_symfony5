<?php

namespace App\Form;

use App\Entity\Profile;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           
            ->add('email',EmailType::class,array(
                'label' => 'Email',
                'attr' => array(
                    'placeholder' => '----> Ex: moi@contact.com ....'
                )
           ))
            ->add('nom', TextType::class,array(
                'label' => 'Nom',
                'attr' => array(
                    'placeholder' => '----> Ex: Dupont ....'
                )
           ))
            ->add('prenom',TextType::class,array(
                'label' => 'Votre Prenom',
                'attr' => array(
                    'placeholder' => ' ----> Ex: Jean ....'
                )
           ))
            ->add('raisonSociale',TextType::class,array(
                'label' => 'Raison sociale de l\'entreprise',
                'attr' => array(
                    'placeholder' => ' ----> Ex: SARL ou SAS ....'
                )
           ))
            ->add('numeroSiret',TextType::class)
            ->add('categorieProfessionnelle', ChoiceType::class, [
                'choices' => [
                    'category' =>[
                        'AGRICULTEURS EXPLOITANTS' => 'AGRICULTEURS EXPLOITANTS' ,
                        'ARTISANS' => 'ARTISANS',
                        'COMMERÇANTS ET ASSIMILES' => 'COMMERÇANTS ET ASSIMILES',
                        'CHEFS D\'ENTREPRISE DE 10 SALARIES OU PLUS' => 'CHEFS D\'ENTREPRISE DE 10 SALARIES OU PLUS',
                    ]
                ],
            ])
            ->add('nombreSalarie', TextType::class,array(
                'label' => 'Nombre de salaries',
                'attr' => array(
                    'placeholder' => ' ----> Ex: 1 ou 2 ou 2000 ....'
                )
           ))
            ->add('creationEntreprise',TextType::class,array(
                'label' => 'Date de creation de votre entreprise ',
                'attr' => array(
                    'placeholder' => ' ----> Ex: 00 janvier  ....'
                )
           ))
            ->add('geolocalisation', ChoiceType::class, [
                'choices' => [
                    'category' =>[
                        'choisir votre Department' => 'choisir votre Department',
                        '17' => '17' ,
                        '33' => '33' ,
                        '28' => '28' ,
                        '75' => '75' ,
                        '78' => '78' ,
                        '92' => '92' ,
                        '2a' => '2a' ,
                        '13' => '13' ,
                        '64' => '64' ,
                    ]
                ],
            ])
            ->add('numeroTelephone',TextType::class,array(
                'label' => 'Telephone',
                'attr' => array(
                    'placeholder' => ' ----> Ex: 06.56 ....'
                )
           ))
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'mot de passe invalide.',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options'  => ['label' => 'Password'],
                'second_options' => ['label' => 'Repeat Password'],
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
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
            ->add('userImage', FileType::class,[
                'label' => 'Brochure (PDF file)',

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid PDF document',
                    ])
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Profile::class,
        ]);
    }
}
