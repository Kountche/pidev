<?php
/**
 * Created by PhpStorm.
 * User: Yosr
 * Date: 07/02/2019
 * Time: 22:53
 */

namespace EventBundle\Controller;



use OrderBundle\Entity\CommentEvent;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use EventBundle\Entity\Evennement;
use EventBundle\Form\EvennementType;
use MyApp\GrapheBundle\Entity\Classe;
use Ob\HighchartsBundle\Highcharts\Highchart;

class EvennementController extends Controller
{
    public function AfficherbackAction()
    {
        $em=$this->getDoctrine()->getManager();
        $event = $em->getRepository("EventBundle:Evennement")->findAll();
        return $this->render('@Event/Evennement/Back/afficher.html.twig',array("events"=>$event));
    }

    public function AfficherfrontAction()
    {
        $em=$this->getDoctrine()->getManager();
        $event = $em->getRepository("EventBundle:Evennement")->findAll();
        return $this->render('@Event/Evennement/Front/afficher.html.twig',array("events"=>$event));
    }


    public function EventfrontAction(Request $request)
    {
        $idEvent = $request->get('idEvent');
        $em = $this->getDoctrine()->getManager();
        $Evennement = $em ->getRepository("EventBundle:Evennement") ->find($idEvent);


    if ($request->isMethod('POST')) {
            $model = new CommentEvent();


            $model->setIdev($Evennement);
            $model->setClientid($this->getUser());
            $model->setComment($request->get('message'));
            // var_dump($model);
            $em=$this->getDoctrine()->getManager();
            $em->persist($model);
            $em->flush();

            return $this->redirectToRoute('evennement_front_event');

        }




        return $this->render('@Event/Evennement/Front/event.html.twig',array("events"=>$Evennement));
    }


    public function EventbackAction(Request $request)
    {
        $idEvent = $request->get('idEvent');
        $em = $this->getDoctrine()->getManager();
        $Evennement = $em ->getRepository("EventBundle:Evennement") ->find($idEvent);
        return $this->render('@Event/Evennement/Back/event.html.twig',array("events"=>$Evennement));
    }


/*    public function SearchAction(Request $request) {

        //$note="tunis";
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository('EventBundle:Participation')->findAll();

        if($request->isMethod('POST')) {
            $note = $request->get('note');
            $em = $this->getDoctrine()->getManager();
            $event = $em ->getRepository("EventBundle:Participation")
                ->findttby($note);
        }

        return $this->render('@Event/Evennement/Back/chercher.html.twig',array("events"=>$event));

    }*/


    public function SearchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $Event = $em->getRepository("EventBundle:Evennement")->findAll();
        if($request->isMethod('POST')) {
            $indice = $request->get('indice');
            $em = $this->getDoctrine()->getManager();
            $Event = $em ->getRepository("EventBundle:Evennement")->findBytt($indice);;
        }

        return $this->render('@Event/Evennement/Back/chercher.html.twig',array("events"=>$Event));

    }



    public function AjouterbackAction(Request $request){
        $Evennement = new Evennement();
        if($request->isMethod('POST')){
            $nom = $request->get('nom');
            $type = $request->get('type');
            //$date= $request->get('date');
            $lieux = $request->get('lieux');
            $nbPlace= $request->get('nbPlace');
            $photo= $request->get('photo');
            $description= $request->get('description');

            $Evennement->setNom($nom);
            $Evennement->setType($type);
           // $Evennement->setDate($date);
            $Evennement->setDate(new \DateTime($request->get('date')));
            $Evennement->setDateFin(new \DateTime($request->get('datefin')));
            $Evennement->setLieux($lieux);
            $Evennement->setNbPlace($nbPlace);
            $Evennement->setPhoto('assets/plugins/images/'.$photo);
            $Evennement->setDescription($description);
            $em = $this->getDoctrine()->getManager();
            $em->persist($Evennement);
            $em->flush();
            return $this->redirectToRoute('evennement_back_afficher');
        }

        return $this->render('@Event/Evennement/Back/ajouter.html.twig');
    }

    public function ModifierbackAction(Request $request)
    {
        $idEvent = $request->get('idEvent');
        $em = $this->getDoctrine()->getManager();
        $Evennement = $em->getRepository('EventBundle:Evennement')->find($idEvent);
        $form = $this->createForm(EvennementType::class,$Evennement);
        $form->handleRequest($request);   //éxecuter
        if($request->isMethod('POST')){
            $nom = $request->get('nom');
            $type = $request->get('type');
           // $date= $request->get('date');
            $lieux = $request->get('lieux');
            $nbPlace= $request->get('nbPlace');
            $photo= $request->get('photo');
            $description= $request->get('description');

            $Evennement->setNom($nom);
            $Evennement->setType($type);
            $Evennement->setDate(new \DateTime($request->get('date')));
            $Evennement->setLieux($lieux);
            $Evennement->setNbPlace($nbPlace);
            $Evennement->setPhoto('assets/plugins/images/'.$photo);
            $Evennement->setDescription($description);
            $em->persist($Evennement);
            $em->flush();
            return $this->redirectToRoute('evennement_back_afficher');
        }
        return $this->render('@Event/Evennement/Back/modifier.html.twig',
            array("events"=>$Evennement));
    }

        public function supprimerbackAction(Request $request)
        {
            $idEvent = $request->get('idEvent');
            $em = $this->getDoctrine()->getManager();   //créer une instance de l'entité manager (action avec la base )
            $Evennement = $em ->getRepository("EventBundle:Evennement") ->find($idEvent);
            $em->remove($Evennement); //supprime le modéle
            $em->flush();   //actualiser
            return $this->redirectToRoute('evennement_back_afficher');
        }

        public function ChercherbackAction(Request $request)
        {
            $em = $this->getDoctrine()->getManager();
            $Evennement = $em ->getRepository("EventBundle:Evennement")->findAll();
            if($request->isMethod('POST')) {
                $lieux = $request->get('lieux');
                //$type = $request->get('type');
                $em = $this->getDoctrine()->getManager();
                $Evennement = $em ->getRepository("EventBundle:Evennement")
                    ->findBy(array(
                        "lieux"=>$lieux
                        //,"type"=>$type
                    ));
            }
            return $this->render('@Event/Evennement/Back/chercher.html.twig',array("events"=>$Evennement));

        }


        public function  chartLineAction()
        {
            $em = $this->container->get('doctrine')->getEntityManager();
            $Evenements = $em->getRepository("EventBundle:Evennement")->findAll();
            $tab = array();
            $categories = array();
            foreach ($Evenements as $Evenement) {
                array_push($tab, $Evenement->getNbPlace());
                array_push($categories, $Evenement->getNom());

            }


            //Chart
            $series = array(array("name" => "Nb de place", "data" => $tab));
            $ob = new Highchart();
            $ob->chart->renderTo('linechart');
            $ob->title->text('Nombre des places par event');
            $ob->xAxis->title(array('text' => "Event"));
            $ob->yAxis->title(array('text' => "Nb de place"));
            $ob->xAxis->categories($categories);
            $ob->series($series);
            return $this->render('@Event/Evennement/Back/chart.html.twig', array('chart' => $ob));
        }

/*
public function commAction(Request $request)
{

    $model = new CommentEvent();

    if ($request->isMethod('POST')) {
        $model->setIdev(1);
        $model->setClientid($request->get('idc'));
        $model->setComment($request->get('message'));
       // var_dump($model);
        $em=$this->getDoctrine()->getManager();
        $em->persist($model);
        $em->flush();


    }
    return $this->redirectToRoute('comm');


}
*/




}