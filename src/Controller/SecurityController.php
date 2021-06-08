<?php

namespace App\Controller;
use App\Entity\Profile;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    public const LAST_EMAIL =  'email_session_en_cour';
    
    
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, EntityManagerInterface $em, UserPasswordEncoderInterface $passwordEncoder): Response
    {    
        //creation du form
        $form =$this->createForm(RegistrationFormType::class);
        $form->handleRequest($request);
       
            if ($form->isSubmitted() && $form->isValid() ){ 
                $user = $form->getData();

                $plainPassword = $form['plainPassword']->getData(); 

                $user->setPassword($passwordEncoder->encodePassword($user, $plainPassword));

                $em->persist($user);
                $em->flush(); 
                $this->get('session')->getFlashBag()->add('success', 'Votre inscription à été pris en compte.');
                return $this->redirectToRoute('app_login');
            }
        return $this->render('registration/register.html.twig',[
            //affichage du rendu -> puis accée a la variable 'registrationForm' dans le template
            'registrationForm'=>$form->createView(),
        ]);
        
    }
    
    #[Route('/login', name: 'app_login')]
    public function login(): Response
    {
        return $this->render('registration/login.html.twig');
        
    }
    
    
    #[Route('/logout', name: 'app_logout')]
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout jey ou your firewall. ');
    }
}
