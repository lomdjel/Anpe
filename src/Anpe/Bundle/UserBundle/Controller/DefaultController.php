<?php

namespace Anpe\Bundle\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpKernel\Bundle;
use Anpe\Bundle\UserBundle\Entity\User;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/user-to-log")
     * @Template()
     */
    public function indexAction()
    {
        return array('name' => $this->getUser()->getUsername());
    }
    
    /**
     * @Route("/create-user")
     * @Template()
     */
    public function createUserAction()
    {
    	$factory = $this->get('security.encoder_factory');
    	$user = new User();
    	$user->setEmail('lomdjel@mailinator.com');
    	$user->setLastname('mawo');
    	$user->setFirstname('lomdjel');
    	$encoder = $factory->getEncoder($user);
    	$password = $encoder->encodePassword('lomdjel', $user->getSalt());
    	$user->setPassword($password);
    	$user->setRole('ROLE_USER');
    	
    	$em = $this->getDoctrine()->getManager();
    	$em->persist($user);
    	$em->flush();
    	return new Response('réalise jespere');
    }
    
}
