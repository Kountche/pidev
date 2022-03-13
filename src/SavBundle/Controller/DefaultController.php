<?php

namespace SavBundle\Controller;
use SavBundle\Entity\ProduitC;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Sav/Default/index.html.twig');
    }

    public function listAction($id)
    {
        $em=$this->getDoctrine();
        $prod=$em->getRepository(@"SavBundle:ProduitC")->find($id);

        return $this->render('@Sav/Default/index.html.twig',array('prod'=>$prod));
    }


}
