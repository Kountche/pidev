<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 16/02/2019
 * Time: 23:13
 */

namespace DeliveryBundle\Controller;
use DeliveryBundle\Entity\Delivery_car;
use DeliveryBundle\Form\Delivery_carType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse ;
use Symfony\Component\HttpFoundation\Response;


class Delivery_carController extends Controller
{




    public function car_ajouterAction(Request $request)
    {

        //pour utiliser la methode post
        if($request->getMethod()=='POST'){

            // pour avoir l identifiant de l utilisateur courant
            $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
            $userID = $this->getUser()->getId();

            //instancer l entité
            $ev=new Delivery_car();
            // l appel de doctrine
            $em=$this->getDoctrine()->getManager();
            // avoir les noms tappés
            $matricule = $request->get('matricule');
            $type = $request->get('type');
            $Status = $request->get('Status');

            // set les données dans les setters
            $ev->setMatricule($matricule) ;
            $ev->setStatus("disponible") ;
            $ev->setType($type) ;
            $ev->setIdUser($userID) ;



            $em->persist($ev); // persister produit dans l entité manager
            $em->flush(); // mise a jour des donnés

          return $this->redirectToRoute("affiche_car" ) ; // afficher le form
        }
        return $this->render('@Delivery/Delivery_car/ajouter_car.html.twig');

    }

    public function     AfficheAction(){

        $em=$this->getDoctrine()->getManager(); // initialiser l entité manager

        $delivery_car=$em->getRepository("DeliveryBundle:Delivery_car")->findAll(); // find les car pour les l utilisateur
        return $this->render('@Delivery/Delivery_car/Affiche.html.twig',array('cars'=>$delivery_car  ));
    }

    public function DeleteAction($Car_Id)
    {
        $em = $this->getDoctrine()->getManager(); // initialiser l entité manager

        $delivery_car = $em->getRepository("DeliveryBundle:Delivery_car")->find($Car_Id); // trouver le car celon son id
        $em->remove($delivery_car); // supprimer le car
        $em->flush(); // faire le mise a jour




        return $this->redirectToRoute('affiche_car');

    }


    public function UpdateAction($Car_Id , Request $request )
    {



        if($request->getMethod() == 'POST') {

            $em = $this->getDoctrine()->getManager(); // initialisation de l entité manager
            $delevery = $em->getRepository(Delivery_car::class)->find($Car_Id);  // trouver le produit celon son id

            // pour avoir l identifiant de l utilisateur courant
            $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
            $userID = $this->getUser()->getId();

            // get les données du twig

            $matricule = $request->get('matricule');
            $type = $request->get('type');
            $status = $request->get('status');



            // set les données
            $delevery->setIdUser($userID) ;
            $delevery->setCar_Id($Car_Id) ;
            $delevery->setType($type) ;
            $delevery->setStatus($status) ;
            $delevery->setMatricule($matricule)  ;

            // persister le produit
            $em->persist($delevery);
            // faire le mise a jour du produit
            $em->flush();




        }

        return $this->redirectToRoute('affiche_car');
    }

    public function     rechercherCarAction($type){



        $em=$this->getDoctrine()->getManager(); // initialiser l entité manager

        $delivery_car=$em->getRepository("DeliveryBundle:Delivery_car")->search($type)  ;
           // ->findBy(array('Type'=>$type  )); // find les car pour les l utilisateur
       return $this->render('@Delivery/Delivery_car/Affiche.html.twig',array('cars'=>$delivery_car  ));
    }



    public function pdfAction(Request $request)
    {
        $snappy = $this->get('knp_snappy.pdf');
        $em=$this->getDoctrine()->getManager();
        $Delivery_car=$em->getRepository("DeliveryBundle:Delivery_car")->findAll();
        $html = $this->renderView('DeliveryBundle:Delivery_car:showpdf.html.twig', array("cars"=>$Delivery_car
            //..Send some data to your view if you need to //
        ));

        $filename = 'myFirstSnappyPDF';

        return new Response(
            $snappy->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'inline; filename="'.$filename.'.pdf"'
            )
        );

    }









}