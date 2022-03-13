<?php
/**
 * Created by PhpStorm.
 * User: servise info
 * Date: 16/02/2019
 * Time: 16:12
 */

namespace MarketingBundle\Controller;

use MarketingBundle\Form\WhishlistType;
use Symfony\Component\HttpFoundation\Request;
use MarketingBundle\Entity\Whishlist;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class WhishlistController extends  Controller
{
    public function addAction($id)
    {
        $user = $this->getUser();
        $wishlist = new Whishlist();

        $em = $this->getDoctrine()->getManager();
        $produit = $em->getRepository('ProductBundle:Products')->find($id);
        $p=$em->getRepository('MarketingBundle:Whishlist')->findByProduct($id);
        if($p==null) {
            $wishlist->setProduct($produit);
            $wishlist->setIduser($user);

            $em->persist($wishlist);
            $em->flush();
        }

        $idd = $this->getUser()->getId();
        $em = $this->getDoctrine()->getManager();
        $wish = $em -> getRepository('MarketingBundle:Whishlist')->findBy(['iduser' => $idd]);
        dump($wish);
        return $this->render('@Marketing/Front/wishlist.html.twig'
            ,array(
                'wishs'=>$wish
            ));    }
    public function showAction()
    {
        if($this->isGranted('ROLE_USER'))
        {
            $id = $this->getUser()->getId();
            $em = $this->getDoctrine()->getManager();
            $wish = $em -> getRepository('MarketingBundle:Whishlist')->findBy(['iduser' => $id]);
        }
        return $this->render('@Marketing/Front/wishlist.html.twig'
            ,array(
                'wishs'=>$wish
            ));
    }
    public function show2Action()
    {
        $em = $this->getDoctrine()->getManager();
        $wish = $em -> getRepository('MarketingBundle:Whishlist')->findByClient();
        return $this->render('@Marketing/Front/wishlist.html.twig'
            ,array(
                'wishs'=>$wish
            ));
    }
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $wish = $em->getRepository("MarketingBundle:Whishlist")->find($id);
        $em->remove($wish);
        $em->flush();
        return $this->redirectToRoute('showWishlist');
    }

    public function showBackAction()
    {
        $em = $this->getDoctrine()->getManager();
        $wish = $em -> getRepository('MarketingBundle:Whishlist')->findAll();
        return $this->render('@Marketing/Back/ShowWishlist.html.twig'
            ,array(
                'wishs'=>$wish
            ));
    }

    public function delete2Action($id)
    {
        $em = $this->getDoctrine()->getManager();
        $wish = $em->getRepository("MarketingBundle:Whishlist")->find($id);
        $em->remove($wish);
        $em->flush();
        return $this->redirectToRoute('ShowWishlist');
    }

}