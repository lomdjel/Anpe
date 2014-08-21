<?php

namespace Anpe\Bundle\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="_default")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
    
    /**
     * @Route("/detail-job", name="_detail_job")
     * @Template()
     */
    public function detailJobAction()
    {
    	return array();
    }
    
    /**
     * @Route("/post-a-job", name="_post_job")
     * @Template()
     */
    public function postJobAction()
    {
    	return array();
    }
    
    /**
     * @Route("/register", name="_register")
     * @Template()
     */
    public function registerAction()
    {
    	return array();
    }
}
