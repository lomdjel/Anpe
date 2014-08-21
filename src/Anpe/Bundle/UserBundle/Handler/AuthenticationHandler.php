<?php 
namespace Anpe\Bundle\UserBundle\Handler;


use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface; 
use Symfony\Component\Security\Core\SecurityContext; 

use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\HttpFoundation\Request; 
use Symfony\Component\HttpFoundation\RedirectResponse; 
use Symfony\Component\Routing\Router; 


class AuthenticationHandler extends ContainerAware implements AuthenticationSuccessHandlerInterface
{
    function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        
    	if($token->getUser()->getRole()->getName()=='ROLE_USER' && !$token->getUser()->getStatus()){
        	$this->container->get('security.context')->setToken(null);
        	$this->container->get('session')->invalidate();
        	$this->container->get('session')->getFlashBag()->add('warning', $this->container->get('translator')->trans('Your account have been disabled. Please contact the admin', array(), 'registration'));
        	return new RedirectResponse($this->container->get('router')->generate('_security_login'));
        }else{
        	$token->getUser()->setLastLoginAt(new \DateTime());
        	$this->container->get('doctrine')->getEntityManager()->flush();
        	
        	$user = $token->getUser();
        	$role = $user->getRole()->getName();
        	
        	if($user->getClient()){
        		$company = $user->getClient()->getCompanyName();
        	}
        	else{
        		$company = '';
        	}
        	
        	
        	switch ($role){
        		case 'ROLE_USER':
        	
        			//Récupère le panier enregistré
        			$session = $this->container->get('session');
        			$client = $user->getClient();
        			if($client && $session){
        				$data = $client->getCart();
        				if($data){
        					$cart = unserialize($data);
        					$session->set('cart', 	  $cart['cart']);
        					$session->set('shipping', $cart['shipping']);
        					$session->set('payment',  $cart['payment']);
        				}
        			}
        	
        			return new RedirectResponse($this->container->get('router')->generate('_index'));
        			break;
        		case 'ROLE_ADMIN':
        			return new RedirectResponse($this->container->get('router')->generate('_dashboard'));
        			break;
        		case 'ROLE_ADV':
        			return new RedirectResponse($this->container->get('router')->generate('_dashboard'));
        		break;        			
        	}
        }
    	
        
        //return new RedirectResponse($this->container->get('router')->generate('_dashboard'));
    }
}