<?php

namespace Anpe\Bundle\UserBundle\Form;

use Doctrine\DBAL\Types\ObjectType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;

class FormHandler{
	public function __construct(Form $form, Request $request)
	{
		$this->form = $form;
		$this->request = $request;
	}
	
	public function process(){
		if ($this->request->getMethod() == 'POST')
		{
			$this->form->bind($this->request);
			if($this->form->isValid()){
				return $this->form->getData();
			}
			
		}
		return false;
	}
	
}