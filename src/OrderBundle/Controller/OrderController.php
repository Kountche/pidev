<?php

namespace OrderBundle\Controller;

use OrderBundle\Entity\CommentEvent;
use OrderBundle\Entity\Orders;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Swap\Builder;
class OrderController extends Controller
{
    public function showcartAction()
    {

        $swap = (new Builder())
            ->add('fixer', ['access_key' => 'c7cb6273c36850201ca2d898bfa8347c'])
            ->add('currency_layer', ['access_key' => '3c185e4125088ab993f14e32d3544b59', 'enterprise' => false])
            ->add('forge', ['api_key' => '7rxgPQc4DsCs6WvTdxvqB7E4LT552zs8'])
            ->build();
        $usd = $swap->latest('USD/USD');
        $eur = $swap->latest('USD/EUR');
        $jpy = $swap->latest('USD/JPY');
        $btc = $swap->latest('USD/BTC');
        $eth = $swap->latest('USD/ETH');

        if ($this->isGranted('ROLE_USER')) {
            $id = $this->getUser()->getId();
            $em = $this->getDoctrine()->getManager();
            $orders = $em->getRepository('OrderBundle:Orders')->findBy(['clientid' => $id]);
            $cart = $em->getRepository('OrderBundle:Cart')->findOneBy(['cartclientid' => $id]);
            if ($orders == null) {
                $cart->setCarttotal(0);
                $em->flush();
            }
            foreach ($orders as $order) {
                $order->setOrdersubtoatal($order->getOrderunitprice() * $order->getOrderamount());

                $em->flush();
            }

            // $cart = $em -> getRepository('OrderBundle:Cart')->find($id);
            $calcule = 0;
            foreach ($orders as $order) {

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
            $stock = 1;

            $order2 = $em->getRepository('OrderBundle:Orders')->findoneby(['clientid' => $id]);
            if ($order2 != null) {
                $prod = $em->getRepository('ProductBundle:Products')->findOneBy(['id' => $order2->getProductid()]);

                if ($prod->getStock() <= $order->getOrderamount()) {
                    $stock = 0;
                }
            }


            /*$swap = (new Builder())
                ->add('fixer', ['access_key' => 'c7cb6273c36850201ca2d898bfa8347c'])
                ->add('currency_layer', ['access_key' => '3c185e4125088ab993f14e32d3544b59', 'enterprise' => false])
                ->add('forge', ['api_key' => '7rxgPQc4DsCs6WvTdxvqB7E4LT552zs8'])
                ->build();
            $usd = $swap->latest('USD/USD');
            $eur = $swap->latest('USD/EUR');
            $jpy = $swap->latest('USD/JPY');
            $btc = $swap->latest('USD/BTC');
            $eth = $swap->latest('USD/ETH');*/


// 1.129
            // echo $eur->getValue();

// 2016-08-26
            // echo $eur->getDate()->format('Y-m-d');

// Historical rate
            //$eur = $swap->historical('EUR/USD', (new \DateTime())->modify('-15 days'));
            return $this->render('@Order\order\cart.html.twig'
                , array(
                    "orders" => $orders, 'cart' => $cart, "count" => $x, "ordersmini" => $orders, "stock" => $stock
                , 'usd' => $usd->getValue(), 'eur' => $eur->getValue(), 'jpy' => $jpy->getValue(), 'btc' => $btc->getValue(), 'eth' => $eth->getValue()
                ));
        } else
            return $this->render('@Order\order\cart.html.twig'
                , array(
                    "orders" => null, 'cart' => null, "count" => 0, "ordersmini" => null, "stock" => 0
                , 'usd' => $usd->getValue(), 'eur' => $eur->getValue(), 'jpy' => $jpy->getValue(), 'btc' => $btc->getValue(), 'eth' => $eth->getValue()
                ));


    }

    /* public function showminicartAction()
     {



         if($this->isGranted('ROLE_USER'))
         {
             $id = $this->getUser()->getId();
             $em = $this->getDoctrine()->getManager();
             $orders = $em -> getRepository('OrderBundle:Orders')->findBy(['clientid' => $id]);

             foreach($orders as $order) {
                 $order->setOrdersubtoatal($order->getOrderunitprice() * $order->getOrderamount());

                 $em->flush();
             }
             $cart = $em -> getRepository('OrderBundle:Cart')->find($id);

             foreach($orders as $order) {
                 $calcule=0;
                 $calcule=$calcule + $order->getOrdersubtoatal();

             }
             if($cart->getCartsubtotal()!=$calcule) {
                 $cart->setCartsubtotal(0);
                 $em->flush();
                 $cart = $em->getRepository('OrderBundle:Cart')->find($id);
                 foreach ($orders as $order) {

                     $cart->setCartsubtotal($cart->getCartsubtotal() + $order->getOrdersubtoatal());
                     // $cart->setCarttotal($cart->getCartsubtotal());
                     $em->flush();
                 }
             }
             $em=$this->getDoctrine()->getManager();
             $orders = $em->getRepository("OrderBundle:Orders")->findBy(['clientid' => $id]);

             return $this->redirectToRoute('cart2'
                 ,array(
                     "ordersmini"=>$orders,'cart'=>$cart
                 ));}
         else
             return $this->redirectToRoute('cart2'
                 ,array(
                     "ordersmini"=>null,'cart'=>null
                 ));


     }*/
    public function updateAction()
    {
        $id = $this->getUser()->getId();
        $em = $this->getDoctrine()->getManager();
        $orders = $em->getRepository('OrderBundle:Orders')->findBy(['clientid' => $id]);

        $cart = $em->getRepository('OrderBundle:Cart')->findOneBy(['cartclientid' => $id]);
        $calcule = 0;
        foreach ($orders as $order) {

            $calcule = $calcule + $order->getOrdersubtoatal();

        }
        if ($cart->getCartsubtotal() != $calcule) {
            $cart->setCartsubtotal(0);
            $em->flush();
            $cart = $em->getRepository('OrderBundle:Cart')->find($id);
            foreach ($orders as $order) {

                $cart->setCartsubtotal($cart->getCartsubtotal() + $order->getOrdersubtoatal());
                // $cart->setCarttotal($cart->getCartsubtotal());
                $em->flush();
            }
        }


        return $this->redirectToRoute('cart');

    }

    public function deleteAction(Request $request)
    {
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $order = $em->getRepository('OrderBundle:Orders')->find($id);
        $em->remove($order);
        $em->flush();

        return $this->redirectToRoute('cart');
    }

    public function clearAction()
    {
        $id = $this->getUser()->getId();
        $em = $this->getDoctrine()->getManager();
        $orders = $em->getRepository('OrderBundle:Orders')->findBy(['clientid' => $id]);
        $cart = $em->getRepository('OrderBundle:Cart')->findOneBy(['cartclientid' => $id]);
        foreach ($orders as $order) {
            $em->remove($order);
            $em->flush();
        }
        $cart->setCarttotal(0);
        $em->flush();
        return $this->redirectToRoute('cart');
    }

    public function editAction(Request $request)
    {
        $id = $request->get("id");
        $stock = 0;
        $em = $this->getDoctrine()->getManager();
        $order = $em->getRepository('OrderBundle:Orders')->find($id);
        $prod = $em->getRepository('ProductBundle:Products')->findOneBy(['id' => $order->getProductid()]);
        if ($prod->getStock() > $order->getOrderamount()) {
            $order->setOrderamount($order->getOrderamount() + 1);
            $em->flush();
            /*$prod->setStock($prod->getStock()-1);
            $em->flush();*/
        } else {
            return $this->redirectToRoute('cart', array(
                "stock" => $stock));
        }


        return $this->redirectToRoute('cart');
    }

    public function edit2Action(Request $request)
    {
        $id = $request->get("id");

        $em = $this->getDoctrine()->getManager();
        $order = $em->getRepository('OrderBundle:Orders')->find($id);
        $prod = $em->getRepository('ProductBundle:Products')->findOneBy(['id' => $order->getProductid()]);
        if ($prod->getStock() > 0 && $order->getOrderamount() > 0) {
            $order->setOrderamount($order->getOrderamount() - 1);
            $em->flush();
            /*$prod->setStock($prod->getStock()+1);
            $em->flush();*/
        }


        return $this->redirectToRoute('cart');
    }

    public function couponAction(Request $request)
    {
        $id = $request->get("name");

        $user = $this->getUser()->getId();
        $em = $this->getDoctrine()->getManager();
        $coupon = $em->getRepository('MarketingBundle:Coupon')->find(1);
        $cart = $em->getRepository('OrderBundle:Cart')->findOneBy(['cartclientid' => $user]);
        //$cart->setCarttotal($cart->getCartsubtotal());

        //$cart->setCarttotal($cart->getCartsubtotal()-($cart->getCartsubtotal() * ($coupon->getCouponAmount()/100)));
        $cart->setCarttotal($cart->getCarttotal() - ($cart->getCarttotal() * ($coupon->getCouponAmount() / 100)));
        $em->flush();


        return $this->redirectToRoute('cart');
    }


    public function addAction(Request $request)
    {

        $id = $this->getUser()->getId();
        $productid = (integer)$request->get('id');

        $neworder = new Orders();
        $em = $this->getDoctrine()->getManager();

        $prod = $em->getRepository('ProductBundle:Products')->findOneBy(['id' => $productid]);
        $cart = $em->getRepository('OrderBundle:Cart')->findOneBy(['cartclientid' => $id]);
        $orders = $em->getRepository('OrderBundle:Orders')->findOneBy(['clientid' => $id, 'productid' => $productid]);
        $sold = $em->getRepository('MarketingBundle:Promotion')->findOneBy(['id' => $prod->getSolde()]);

        if ($orders == null) {
            //foreach($cart as $cartid) {
            $neworder->setCartid($cart);
            $neworder->setClientid($cart->getCartclientid());
            // }

            $neworder->setProductid($prod);

            $neworder->setOrderamount(1);
            $neworder->setOrderunitprice($prod->getPrice() - (($prod->getPrice() * $sold->getDiscount()) / 100));
            $neworder->setOrdersubtoatal(1 * $prod->getPrice());
            $neworder->setOrdertotal(0);

            /*foreach($prod as $prodid) {
                $neworder->setOrderunitprice($prodid->getPrice());
            }*/


            $em->persist($neworder);
            $em->flush();
        } else {
            $orders->setOrderamount($orders->getOrderamount() + 1);
            $em->flush();
        }

        return $this->redirectToRoute('cart');

    }

    public function ajaxAction(Request $request)
    {
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $order = $em->getRepository('OrderBundle:Orders')->find($id);
        /*$em -> remove($order);
        $em -> flush();*/
        if ($request->isXmlHttpRequest() || $request->query->get('showJson') == 1) {
            $jsonData = array();
            $idx = 0;
            foreach ($order as $student) {
                $temp = array(
                    'name' => $student->getName(),
                    'address' => $student->getAddress(),
                );
                $jsonData[$idx++] = $temp;
            }
            return new JsonResponse($jsonData);
        } else {
            return $this->render('default/index3.html.twig');
        }
    }

    public function pointsAction(Request $request)
    {
        $user = $this->getUser();
        $id = $this->getUser()->getId();
        $points = $user->getPoints();
        $nb = $request->get("points");
        $user->setPoints($points - $nb);
        $em = $this->getDoctrine()->getManager();
        $cart = $em->getRepository('OrderBundle:Cart')->findOneBy(['cartclientid' => $id]);
        $cart->setCarttotal($cart->getCarttotal() - $nb / 100);
        $em->flush();
        return $this->redirectToRoute('cart');
    }

//iheb edit
    public function add2Action(Request $request)
    {

        $id = $this->getUser()->getId();
        $productid = $request->get('id');
        $amount = $request->get('qty');
        var_dump($amount);


        $neworder = new Orders();
        $em = $this->getDoctrine()->getManager();

        $prod = $em->getRepository('ProductBundle:Products')->findOneBy(['id' => $productid]);
        $cart = $em->getRepository('OrderBundle:Cart')->findOneBy(['cartclientid' => $id]);
        $orders = $em->getRepository('OrderBundle:Orders')->findOneBy(['clientid' => $id, 'productid' => $productid]);
        $sold = $em->getRepository('MarketingBundle:Promotion')->findOneBy(['id' => $prod->getSolde()]);

        if ($orders == null) {
            //foreach($cart as $cartid) {
            $neworder->setCartid($cart);
            $neworder->setClientid($cart->getCartclientid());
            // }

            $neworder->setProductid($prod);

            $neworder->setOrderamount($amount);
            $neworder->setOrderunitprice($prod->getPrice() - (($prod->getPrice() * $sold->getDiscount()) / 100));
            $neworder->setOrdersubtoatal($amount * $prod->getPrice());
            $neworder->setOrdertotal($amount * $prod->getPrice());

            /*foreach($prod as $prodid) {
                $neworder->setOrderunitprice($prodid->getPrice());
            }*/


            $em->persist($neworder);
            $em->flush();
        } else {
            $orders->setOrderamount($orders->getOrderamount() + 1);
            $em->flush();
        }

        return $this->redirectToRoute('cart');

    }

/*
    public function commAction(Request $request)
    {

        $model = new CommentEvent();

        if ($request->isMethod('POST')) {
            $model->setIdev(1);
            $model->setClientid($request->get('idc'));
            $model->setComment($request->get('message'));
            var_dump($model);
            $em=$this->getDoctrine()->getManager();
            $em->persist($model);
            $em->flush();


        }
        return $this->redirectToRoute('evennement_front_event');


    }
*/

}