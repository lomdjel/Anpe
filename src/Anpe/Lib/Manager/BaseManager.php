<?php

namespace Anpe\Lib\Manager;

use Doctrine\ORM\Mapping\Entity;
/**
 * BaseManage Class
 *
 * Cette classe abstraite donne les méthodes CRUD pour interagir avec la base de données
 * Toutes les classes héritant de cette 
 *
 * @version 1.0
 * @author Alain ATTICA <alain.attica@adixon.fr>
 * @access abstract
 * @project SunFlow
 */
abstract class BaseManager
{
	
	protected $path;
	protected $em;
	
	/**
	 * Enregistre dans la base de données mon entité passée en paramètre
	 * 
	 * @param $entity, objet Entity
	 * @return null
	 *
	 */	
    protected function persistAndFlush($entity)
    {
    	try {
        	$this->em->persist($entity);
        	$this->em->flush();
        	return $entity;
        } catch (Exception $e) {
        	echo $e->getMessage();
        	return false;
        }
    }

    /**
     * Récupère un objet Entity de la base de donnée
     *
     * @param $id, 
     * @return objet Entity
     *
     */    
    public function load($id)
    {
    	return $this->getRepository()->findOneBy(array('id' => $id));
    }


    /**
     * Enregistre dans la base de données un entity
     *
     * @param $objet, entity
     * @param $date, l'entity n'a pas d'information de date
     * @return null
     *
     */
    public function create($Object, $date=true)
    {
    	if($date){
	    	$Object->setCreatedAt(date_create(date("Y-m-d H:i:s")));
	    	$Object->setUpdatedAt(date_create(date("Y-m-d H:i:s")));
    	}
    	return $this->persistAndFlush($Object);
    }

    /**
     * Enregistre dans la base de données un entity
     *
     * @param $objet, entity
     * @param $date, l'entity n'a pas d'information de date
     * @return null
     *
     */
    public function save($Object, $date=true)
    {
    	return $this->persistAndFlush($Object);
    }
       
    
    /**
     * Supprime de la base de donnée l'objet entity
     *
     * @param $objet, entity
     * @return null
     *
     */    
    public function delete($Object)
    {
    	try {
			$this->em->remove($Object);
    		$this->em->flush();
    		return true;    		
    	} catch (Exception $e) {
    		echo $e->getMessage();
        	return false;
    	}
    }

    
    /**
     * Met a jour l'objet entity
     *
     * @param $objet, entity
     * @return null
     *
     */    
    public function update($Object)
    {
    	$Object->setUpdatedAt(date_create(date("Y-m-d H:i:s")));
    	return $this->persistAndFlush($Object);
    }

    
    
    /**
     * Met a jour l'objet entity
     *
     * @param $objet, entity
     * @return null
     *
     */
    public function refresh($Object)
    {
  		$this->em->refresh($Object);
    }
    
	public function getRepository()
	{
		return $this->em->getRepository($this->path);
	}
}
