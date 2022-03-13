<?php

namespace DeliveryBundle\Controller;

use DeliveryBundle\Entity\Delivery_orders;
use DeliveryBundle\Entity\Delivery_car;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
class DeleveryOrderController extends Controller
{
    public function indexAction()
    {
    }






    public function Order_ajouterAction(Request $request)
    {

// get current user
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
        $userID = $this->getUser()->getId();

        //instancer l entité
        $ev=new Delivery_orders();
        // l appel de doctrine
        $em=$this->getDoctrine()->getManager();
        //pour utiliser la methode post
        if($request->getMethod()=='POST'){


            // get date de template
            $Date = $request->get('Date') ;
            // get amount de template
            $Amount = $request->get('Amount') ;



            // get localisation de template
            $loc = $request->get('localistion') ;

            // mettre le valeur de latitude et longitude
            $lat = (float)substr($loc , 0 , 8) ;
            $long= (float)substr($loc , 9 , 18     ) ;

            // setter les valeur pour persister au base de données
           $ev->setLongi($long) ;
           $ev->setLat ($lat);
           $ev->setDate($Date) ;
           $ev->setAmount($Amount) ;

           $ev->setIdCar($request->get('idCar') );
           $ev->setIdCurrent($userID);


            $em->persist($ev); // persister produit dans l entité manager
            $em->flush(); // mise a jour des donnés
            return $this->redirectToRoute('MyOrder');

        }
        return $this->render('@Delivery/Delivery_orders/ajoutOrder.html.twig' );

    }




    public function     OrderUserCAction(){

        $em=$this->getDoctrine()->getManager(); // initialiser l entité manager

        $delivery_car=$em->getRepository("DeliveryBundle:Delivery_car")->findAll(); // find les car pour les l utilisateur
        return $this->render('@Delivery/Delivery_orders/OrderUser.html.twig',array('cars'=>$delivery_car  ));// render ti view avec
    }



    public function     TransitionAction($CarId){


        $em = $this->getDoctrine()->getManager(); // initialisation de l entité manager
        $delevery = $em->getRepository(Delivery_car::class)->find($CarId);  // trouver le produit celon son id
        $delevery->setStatus("en service") ; // modifier l etat du status

        $em->persist($delevery);
        // faire le mise a jour du produit
        $em->flush();
        return $this->render('@Delivery/Delivery_orders/ajoutOrder.html.twig',array('cars'=>$CarId  ));
    }

    public function     AfficheMyorderAction(){


        // current user
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
        $userID = $this->getUser()->getId();

        $em=$this->getDoctrine()->getManager(); // initialiser l entité manager

        $delivery_car=$em->getRepository("DeliveryBundle:Delivery_orders")->findBy(array('idCurrent'=>$userID  )); // find les car pour les l utilisateur
        return $this->render('@Delivery/Delivery_orders/MyOrders.html.twig',array('cars'=>$delivery_car  )); // retourner la page
    }






    public function affichermapAction($long ,$lat)
    {

        // retourner la longitute et latitude pour le map
        return $this->render('@Delivery/Delivery_orders/map.html.twig',array('long'=>$long , 'lat'=>$lat));
    }






    public function     AfficheAdminorderAction(){

        // get the current user
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
        $userID = $this->getUser()->getId();

        $em=$this->getDoctrine()->getManager(); // initialiser l entité manager

        $delivery_car=$em->getRepository("DeliveryBundle:Delivery_orders")->findAll(); // find les car pour les l utilisateur
        return $this->render('@Delivery/Delivery_orders/AllOrder.html.twig',array('cars'=>$delivery_car  ));
    }





    public function     EndOrderAction($CarId , $id){


        $em = $this->getDoctrine()->getManager(); // initialisation de l entité manager
        $delevery = $em->getRepository(Delivery_car::class)->find($CarId);  // trouver le produit celon son id
        $delevery->setStatus("disponible") ;

        $em->persist($delevery);
        // faire le mise a jour du produit
        $em->flush();









        $delivery_car = $em->getRepository("DeliveryBundle:Delivery_orders")->find($id); // trouver le car celon son id
        $em->remove($delivery_car); // supprimer le car
        $em->flush(); // faire le mise a jour




        return $this->redirectToRoute('MyOrder');



    }






}
