<?php

namespace App\Security;

use App\Repository\ProfileRepository;
use App\Controller\SecurityController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\PassportInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\RememberMeBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\PasswordUpgradeBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;



class LoginAuthenticator extends AbstractAuthenticator
{
    
    private $ProfileRepository;
    
   
    public function __construct(ProfileRepository $ProfileRepository, UrlGeneratorInterface $urlGenerator)
    {
        $this->ProfileRepository = $ProfileRepository;
        $this->userGenerator = $urlGenerator;
    }
    /**
    * la methode support retourne true or false si la route indiqué est vrais 
     */
    public function supports(Request $request): ?bool
    {
        return $request->attributes->get('_route') === 'app_login' && $request->isMethod('POST');
    }

    /**;
     * créé un passport pour le User, avec toutes ces information et assigne un jeton au User qui a valeur du mot de passe  .
     * si vrais elle appele la méthode "onAuthenticationSuccess"
     * si faux elle appéle la méthode "onAuthenticationFailure"
     * @throws AuthenticationException
     */
    public function authenticate(Request $request): PassportInterface
    {
        
        //"$request->request" indique que c'est une requette _POST;
        //"$request->query" indique que c'est une requette _GET;
        //"$request->attribut" indique que c'est une requette des attributs de symfony;
        //findOneByEmail recherche dans la D_B si l'utilisateur et present
        // autre symtaxe = findOneBy(['email'=> $request->request->get('email')])
        $user = $this->ProfileRepository->findOneByEmail($request->request->get('email'));
        
        //permet de garder en memoire le dernier mail enregistré 
        $request->getSession()->set(
            SecurityController::LAST_EMAIL,$request->request->get('email')
        );
        if (!$user) {
            //il léve une exeption si true appele la function"onAuthenticationFailure"
            //si false il appele la function "onAuthenticationSuccess"
            throw new UsernameNotFoundException;
        }
        return new Passport(
            $user, 
            new PasswordCredentials($request->get('password')), [
            // protection csrf avec des token csrf
                new CsrfTokenBadge('login_form', $request->get('csrf_token')),
                new RememberMeBadge,

            // and add support for upgrading the password hash
            // new PasswordUpgradeBadge($request->get('password'), $this->ProfileRepository),
        ]);
    }
    /**
     * 
     *"RedirectResponse( $this->userGenerator->generate" va generé l'url vers la route que l'on à indiqué
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response{
        
        $request->getSession()->remove('SecurityController::LAST_EMAIL');
        return new RedirectResponse( $this->userGenerator->generate('app_home') );
    
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        return new RedirectResponse( $this->userGenerator->generate('app_login') );
       

    }
}