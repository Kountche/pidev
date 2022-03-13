<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/aabb", name="homepage")
     */
    public function indexAction(Request $request)
    {
       if( $this->isGranted('ROLE_ADMIN'))

           return $this->render('default/index2.html.twig');



       if($this->isGranted('ROLE_USER'))
           return $this->render('default/index3.html.twig');

        return $this->render('default/index3.html.twig');



    }

    /**
     * @Route("/admin", name="admin")
     */
    public function indexAction2(Request $request)
    {
         if($this->isGranted('ROLE_ADMIN')) {
             return $this->render('default/index2.html.twig');
         }
         return $this->render('default/index.html.twig');





    }
    /**
     * @Route("/user", name="user")
     */
    public function indexAction3(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');


        //return $this->render('default/index3.html.twig');

        //iheb edit
        if( $this->isGranted('ROLE_ADMIN'))

            return $this->render('default/index2.html.twig');

        if($this->isGranted('ROLE_USER')) {
            $id = $this->getUser()->getId();
            $em = $this->getDoctrine()->getManager();
            $orders = $em->getRepository('OrderBundle:Orders')->findBy(['clientid' => $id]);

            foreach ($orders as $order) {
                $order->setOrdersubtoatal($order->getOrderunitprice() * $order->getOrderamount());

                $em->flush();
            }
            $cart = $em->getRepository('OrderBundle:Cart')->find($id);

            foreach ($orders as $order) {
                $calcule = 0;
                $calcule = $calcule + $order->getOrdersubtoatal();

            }
            if ($cart->getCartsubtotal() != $calcule) {
                $cart->setCartsubtotal(0);
                $em->flush();
                $cart = $em->getRepository('OrderBundle:Cart')->findOneBy(['cartclientid' => $id]);
                foreach ($orders as $order) {

                    $cart->setCartsubtotal($cart->getCartsubtotal() + $order->getOrdersubtoatal());
                    $cart->setCarttotal($cart->getCartsubtotal());
                    $em->flush();
                }
                /*$cart->setCarttotal($cart->getCartsubtotal());
               $em->flush();*/
            }
            $em = $this->getDoctrine()->getManager();
            $orders = $em->getRepository("OrderBundle:Orders")->findBy(['clientid' => $id]);
            $x = 0;
            $id = $this->getUser()->getId();
            $em = $this->getDoctrine()->getManager();
            $count = $em->getRepository('OrderBundle:Orders')->findBy(['clientid' => $id]);
            foreach ($count as $c) {
                $x = $x + 1;
            }
        }
        return $this->render('default/index3.html.twig',array(
            "orders"=>$orders,'cart'=>$cart,"count"=>$x,"ordersmini"=>$orders));


    }

}
