<?php

namespace Anpe\Bundle\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpKernel\Bundle;
use Symfony\Component\HttpFoundation\Response;
use Anpe\Bundle\UserBundle\Entity\User;
use Anpe\Bundle\UserBundle\Form\RegistrationForm;
use Anpe\Bundle\UserBundle\Form\FormHandler;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;

class RegistrationController extends Controller
{
	/**
	 * @Route("/registration", name="_registration")
	 * @Template()
	 */
	public function registrationAction()
	{
		$form = $this->createForm(new RegistrationForm(),new User());
		$formhandler = new FormHandler($form,$this->getRequest());
		if ($user = $formhandler->process()) {
			$user->setSalt(md5(time()));
			$encoder = new MessageDigestPasswordEncoder('sha512', true, 10);
			$password = $encoder->encodePassword($user->getPassword(), $user->getSalt());
			$user->setPassword($password);
			$this->get('anpe.user_manager')->create($user);
			$this->get('session')->getFlashBag()->add('success', $this->get('translator')->trans('User create', array(), ''));
			return $this->redirect($this->generateUrl('_default'));
		}
		
		return array('form' => $form->createView());
	}
}
