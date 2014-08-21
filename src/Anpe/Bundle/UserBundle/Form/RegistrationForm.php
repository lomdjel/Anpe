<?php

namespace Anpe\Bundle\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class RegistrationForm extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			/* ->add('civility', 'choice', array('label' => '* Civility',
				'choices'   => array('M' => 'M.', 'Mme' => 'Mme'),
				'data' => 'M', 
				'attr' => array('display' => 'inline'),
				'expanded'	=> true,
				'required'  => true,
			))
			->add('profession', 'text', array('label' => '* Fonction',
				'required'=> true))
				
				->add('phone', 'text', array('label' => '* Phone Number',
					'required'=> true))
			
			->add('mobile', 'text', array('label' => 'Mobile Number',
					'required'=> false))
		
			->add('companyName', 'text', array('label' => '* Company Name',
					'required'=> true))
					
			->add('companyContactName','text', array('label' => '* Company Contact Name',
					'required' => true	))
					
			->add('companyAdress','text', array('label' => '* Address',
					'required' => true))

			->add('companyAdress2','text', array('label' => 'Rest Address',
					'required' => false))
					
			->add('companyCP','text', array('label' => '* Postal Code',
					'required' => true))
										
			->add('companyCity','text', array('label' => '* City',
					'required' => true))
												
			->add('deliveryCountry','text', array('label' => '* Country',
					'required' => true))
			
			->add('companyCountry', 'entity', array('label' => '* Country',
					'empty_value' => 'Choose a Country',
					'class' => 'ExtranetB2BFrontBundle:Country',
					'property' => 'name',
					'required' => true
			))
			
			->add('companyCodeTVA', 'text', array('label' => 'VAT Code/Id Number',
					'required'=> false))
					
			->add('newsletter', 'checkbox', array('label' => 'Newsletter',
					'attr'     => array('checked'   => 'checked'),
					'required'  => false,
			))
			 */
			
			->add('lastname', 'text', array('label' => '* Lastname',
					'required'=> true,
					'attr' => array('class' => 'input-xlarge focused'),
			))
		
			->add('firstname', 'text', array('label' => '* Firstname',
				'required'=> true,
				'attr' => array('class' => 'input-xlarge focused'),
			))
				
			

			->add('email', 'repeated', array(
				'first_options'  => array('label' => '* Email'),
				'second_options' => array('label' => '* Confirm Email'),
				'type'        => 'email',
				'attr' => array('class' => 'input-xlarge focused'),
			))
			
			->add('password', 'repeated', array(
				'first_options'  => array('label' => '* Password'),
				'second_options' => array('label' => '* Confirm Password'),
				'type'        => 'password',
				'attr' => array('class' => 'input-xlarge'),
			))
				
			
			
			
			;
	}
	
	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
				'translation_domain' => 'registration'
		));
	
	}
	
	public function getName()
	{
		return 'registration_user';
	}
}
