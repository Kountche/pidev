<?php
/**
 * Created by PhpStorm.
 * User: Yosr
 * Date: 09/02/2019
 * Time: 04:38
 */

namespace EventBundle\Controller;


use EventBundle\Entity\Participation;
use EventBundle\Entity\Evennement;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use MyApp\GrapheBundle\Entity\Classe;
use Ob\HighchartsBundle\Highcharts\Highchart;
use Zend\Json\Expr;


class ParticipationController extends Controller
{

    public function ParticipationAction()
    {
        $em=$this->getDoctrine()->getManager();
        $Participation = $em->getRepository("EventBundle:Participation");
        $nb = $Participation->getNb();
        return $this->render('@Event/Participation/afficher.html.twig',array("nb"=>$nb));
    }

    public function AfficherbackAction()
    {
        $em=$this->getDoctrine()->getManager();
        $event = $em->getRepository("EventBundle:Participation");
        $nb = $event->getNb();
        return $this->render('@Event/Participation/events.html.twig',array("nb"=>$nb));
    }

    public function AfficherfrontAction()
    {
        $em=$this->getDoctrine()->getManager();
        $event = $em->getRepository("EventBundle:Participation");
        $nb = $event->getNb();
        return $this->render('@Event/Evennement/Front/afficher.html.twig',array("nb"=>$nb));
    }




    public function  chartLineAction()
    {
        $em = $this->container->get('doctrine')->getEntityManager();
        $Participations = $em->getRepository("EventBundle:Participation")->getNb();
        //$nb = $Participations->getNb();

        $tab = array();
        $categories = array();
        foreach ($Participations as $Participation) {
            array_push($tab,  intval($Participation['id']."<br />"));
            array_push($categories, $Participation['nom']."<br />");
        }
        //Chart
        $series = array(array("name" => "Nb de participants", "data" => $tab));
        $ob = new Highchart();
        $ob->chart->renderTo('linechart');
        $ob->title->text('number of participants in an event');
        $ob->xAxis->title(array('text' => "Event"));
        $ob->yAxis->title(array('text' => "Number of participants"));
        $ob->xAxis->categories($categories);
        $ob->series($series);
        return $this->render('@Event/Participation/chart1.html.twig', array('chart' => $ob));
    }




    public function chartPieAction(){
        $ob = new Highchart();
        $ob->chart->renderTo('piechart');
        $ob->title->text('Pourcentages of participants in an event');
        $ob->plotOptions->pie(array(
            'allowPointSelect' => true,
            'cursor' => 'pointer',
            'dataLabels' => array('enabled' => false),
            'showInLegend' => true
        ));
        $em= $this->container->get('doctrine')->getEntityManager();


        $Participations = $em->getRepository("EventBundle:Participation")->getNb();
        $totalParticipant=0;
        foreach ($Participations as $Participation) {
            $totalParticipant=$totalParticipant+intval($Participation['id']."<br />") ;
        }
            $data=array();
        foreach ($Participations as $Participation) {
            $stat=array();
            array_push($stat,$Participation['nom']."<br />",(intval($Participation['id']."<br />")  *100)/$totalParticipant);
            array_push($data,$stat);
        }


        $ob->series(array(array('type' => 'pie','name' => 'Browser share', 'data' => $data)));
        return $this->render('@Event/Participation/chart.html.twig',
            array(
                'chart' => $ob
            ));
    }


    public function chartHistogrammeAction()
    {
        $em = $this->container->get('doctrine')->getEntityManager();
        $Participations = $em->getRepository("EventBundle:Participation")->getNb();
        //$nb = $Participations->getNb();

        $tab = array();
        $categories = array();
        foreach ($Participations as $Participation) {
            array_push($tab,  intval($Participation['moyenne']."<br />"));
            array_push($categories, $Participation['nom']."<br />");
        }



      $series = array(
    array(
        'name' => 'Event',
        'type' => 'column',
        'color' => '#AC1C30',
        'yAxis' => 0,
        'data' => $tab,
    ));
        $yData = array(
    array('labels' => array('formatter' => new Expr('function () { return this.value + "" }'),
            'style' => array('color' => '#4572A7')
        ),
        'gridLineWidth' => 0,
        'title' => array(
            'text' => 'Note',
            'style' => array('color' => '#4572A7')
        ),),);
        $ob = new Highchart();
        $ob->chart->renderTo('container'); // The #id of the div where to render the chart
        $ob->chart->type('column');
        $ob->title->text('the average of the event');
        $ob->xAxis->categories($categories);
        $ob->yAxis($yData);
        $ob->legend->enabled(false);
        $formatter = new Expr('function () { var unit = { "Etudiant": "étudiant(s)",}[this.series.name];
        return this.x + ": <b>" + this.y + "</b> " + unit;}');
        $ob->tooltip->formatter($formatter);
        $ob->series($series);
        return $this->render('@Event/Participation/chart2.html.twig', array(
        'chart' => $ob));
    }




   /* public function EventbackAction(Request $request)
    {
        $idEvent = $request->get('idEvent');
        $em = $this->getDoctrine()->getManager();
        $Evennement = $em ->getRepository("EventBundle:Evennement") ->find($idEvent);
        return $this->render('@Event/Evennement/Back/event.html.twig',array("events"=>$Evennement));
    }*/


    //5alta sala7a
    public function SearchAction(Request $request) {

        //$note="tunis";
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository('EventBundle:Participation')->getNb();

        if($request->isMethod('POST')) {
            $note = $request->get('note');
            $em = $this->getDoctrine()->getManager();
            $event = $em ->getRepository("EventBundle:Participation")
                ->findttby($note);
        }

        return $this->render('@Event/Participation/search.html.twig',array("nb"=>$event));

    }


  /*  public function ChercherbackAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $Evennement = $em ->getRepository("EventBundle:Evennement")->findAll();
        if($request->isMethod('POST')) {
            $lieux = $request->get('lieux');
            $em = $this->getDoctrine()->getManager();
            $Evennement = $em ->getRepository("EventBundle:Evennement")
                ->findBy(array("lieux"=>$lieux));
        }
        return $this->render('@Event/Evennement/Back/chercher.html.twig',array("events"=>$Evennement));

    }*/


     //hédhy s7i7a
   /* public function AjouterfrontAction(Request $request){
        
        $idEvent = $request->get('idEvent');
        $Participation = new Participation();
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $Evennement = $em->getRepository("EventBundle:Evennement")->find($idEvent);
        $Participation->setEvennement($Evennement);
        $Participation->setUser($user);

        // $Participation->setUser(1);
        $Participation->setNote(5);
        $em = $this->getDoctrine()->getManager();
        $em->persist($Participation);
        $em->flush();

        return $this->redirectToRoute('evennement_front_afficher');




    }*/



    //try to inmachiha


    public function AjouterfrontAction(Request $request){

        $idEvent = $request->get('idEvent');
        $user = $this->getUser();

        $em=$this->getDoctrine()->getManager();
        $Participation = $em->getRepository("EventBundle:Participation")->findAll();
        $nb=0;
        foreach ($Participation as $part ) {
            $Evennement = $em->getRepository("EventBundle:Evennement")->find($idEvent);
            if (($Evennement == $part->getEvennement()) && ($user == $part->getUser() )) {
                $nb++;
            }}

            if ($nb==0){

                $Participation = new Participation();

                $em = $this->getDoctrine()->getManager();
                $Evennement = $em->getRepository("EventBundle:Evennement")->find($idEvent);
                $Participation->setEvennement($Evennement);
                $Participation->setUser($user);

                $Participation->setNote(5);
                $em = $this->getDoctrine()->getManager();
                $em->persist($Participation);
                $em->flush();
            }
       // die("nnnnnnnnnnnnnnnnnnnb :" .$nb );
        return $this->redirectToRoute('evennement_front_afficher');

    }





   /* public function AjouterfrontAction(Request $request){
        $idEvent = $request->get('idEvent');

        $Participation = new Participation();

        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $Evennement = $em->getRepository("EventBundle:Evennement")->find($idEvent);
        $Participation->setEvennement($Evennement);
        $Participation->setUser($user);

        // $Participation->setUser(1);
        $Participation->setNote(5);
        $em = $this->getDoctrine()->getManager();
        $em->persist($Participation);
        $em->flush();

        return $this->redirectToRoute('evennement_front_afficher');

    }  */








    public function ModifierfrontAction(Request $request){

        $idEvent = $request->get('idPart');
        $em = $this->getDoctrine()->getManager();
        $Participation = $em->getRepository('EventBundle:Participation')->findOneBy(["idParticipation"=>$idEvent]);
        $event= $em->getRepository('EventBundle:Evennement')->findOneBy(["idEvent"=>$Participation->getEvennement()]);

        if($request->isMethod('POST'))
        {

            $note= $request->get('note');
            $Participation->setNote($note);
            $em->persist($Participation);
            $em->flush();
            return $this->redirectToRoute('evennement_front_mine');


        }
        return $this->render('@Event/Evennement/Front/modifier.html.twig',array("part"=>$Participation,"event"=>$event));
    }













    public function RechercheAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $Participation = $em->getRepository("EventBundle:Participation")->findAll();
        if($request->isMethod('POST'))
        {
            $event=$request->get('event');
            $Participation = $em ->getRepository("EventBundle:Participation")->findByEU($event);
        }

        return $this->render('@Event/Participation/chercher.html.twig',array("Participations"=>$Participation));
    }


    /*public function tricountAction()
    {
        $em = $this->getDoctrine()->getManager();
        $event = $this->getDoctrine()->getRepository("EventBundle:Participation")->findByCount();
        return $this->render('@Event/Participation/event.html.twig',array("events"=>$event));

    }*/

    public function mineAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $locationRepo = $em->getRepository('EventBundle:Participation');
        $test=0;
        $nb = $locationRepo->Join();
     /*  foreach ($nb as $data)
            //=$data;
        die("test :" .$data);*/



        return $this->render('@Event/Participation/event.html.twig',array("nb"=>$nb));


    }


    public function SupprimerfrontAction(Request $request)
    {
        $idEvent = $request->get('idEvent');
        $em = $this->getDoctrine()->getManager();   //créer une instance de l'entité manager (action avec la base )
        $Participation = $em ->getRepository("EventBundle:Participation") ->find($idEvent);
        $em->remove($Participation); //supprime le modéle
        $em->flush();   //actualiser
        return $this->redirectToRoute('evennement_front_mine');
    }






}