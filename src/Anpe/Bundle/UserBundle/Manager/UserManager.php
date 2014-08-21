<?php

namespace Anpe\Bundle\UserBundle\Manager;

use Anpe\Lib\Manager\BaseManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Entity;
use Anpe\Bundle\UserBundle\Entity\User;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;

/**
 * BaseManage Class
 *
 * Cette classe abstraite donne les méthodes CRUD pour interagir avec la base de données
 * Toutes les classes héritant de cette 
 *
 * @version 1.0
 * @author Alain ATTICA <alain.attica@adixons.fr>
 * @access abstract
 * @project SunFlow
 */
class UserManager extends BaseManager
{
	public function __construct(EntityManager $em)
    {
        $this->path = 'AnpeUserBundle:User';
        $this->em = $em;
    }
    
	
	public function createUser($User){
		
		if(!is_null($client->getPassword())){
			$user->setPassClaire($client->getPassword());
			$user->setSalt(md5(time()));
			$encoder = new MessageDigestPasswordEncoder('sha512', true, 10);
			$password = $encoder->encodePassword($client->getPassword(), $user->getSalt());
			$user->setPassword($password);
		}else {
			$user = $this->addSaltAndPassAction($user);
		}
		
		if(!$client->getSites()->isEmpty()){
			$user = $this->appendToCollection($user, $client);
		}
		
		$user->setNewsletter($client->getNewsletter());
		$user->setRole($roleClient);
		$user->setClient($client);
		$user->setStatus(false);

		$user = $this->create($user);

		return $user;
	}
	
	public function findByEmail($email){
		return $this->getRepository()->findOneBy(array('email' => $email));
	}
	
	public function createPassAction(){
		$voyelle = array('a','e','u','i','o','y');
		$consonne = array('b','c','d','f','g','h','j','k','l','m','n','p','q','r','s','t','v','w','x','z');
		$pass=array();
		for ($i=0;$i<6;$i++){
			if (($i%2)==0){
				shuffle($voyelle);
				array_push($pass,$voyelle[$i]);
			}else{
				shuffle($consonne);
				array_push($pass,$consonne[$i]);
			}
		}
		$data = rand(0,9);
		array_push($pass, $data);
		return (implode($pass));
		
	}
	
	public function addSaltAndPassAction(User $user){
		$user->setSalt(md5(time()));
		$encoder = new MessageDigestPasswordEncoder('sha512', true, 10);
		$pass = $this->createPassAction();
		$user->setPassClaire($pass);
		$password = $encoder->encodePassword($pass, $user->getSalt());
		$user->setPassword($password);
		return $user;
	}
	
	//Verifie existance email
	public function checkUniqueEmail($email){
		if($this->getRepository()->checkUniqueEmail($email) > 0)
			return false;
		else 
			return true;
	}
	
}
