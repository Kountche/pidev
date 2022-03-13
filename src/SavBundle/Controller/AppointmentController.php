<?php

namespace SavBundle\Controller;

use SavBundle\Entity\Appointment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Date;
class AppointmentController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Sav/Reclamation_front/Appointment_front.html.twig');
    }

    public function ajoutappAction(Request $request)
    {

        $model = new Appointment();
        if ($request->isMethod('POST')) {



            $model->setAppointmentuserid($request->get('app_userid'));
            $model->setAppointmentusername($request->get('app_username'));
            $model->setAppointmenttime($request->get('app_time'));
            $model->setAppointmentdate(new \DateTime($request->get('app_date')));
            $model->setAppointmentetat($request->get('app_etat'));
            $model->setAppointmentmotif($request->get('app_pat'));
            $model->setAppointmentemail($request->get('app_email'));


            $em = $this->getDoctrine()->getManager();
            $em->persist($model);
            $em->flush();


        }
        return $this->render('@Sav/Reclamation_front/Appointment_front.html.twig',array('model'=>$model));
    }


    public function listAction()
    {
        $em=$this->getDoctrine();
        $Appointment=$em->getRepository(@"SavBundle:Appointment")->findAll();

        return $this->render('@Sav/Reclamation_front/Appointment_list.html.twig',array('Appointment'=>$Appointment));
    }


    public function suppappAction(Request $request, $id)
    {
        $Appointment= new Appointment();
        $em=$this->getDoctrine()->getManager();
        $Appointment=$em->getRepository(@"SavBundle:Appointment")->find($id);
        $em->remove($Appointment);
        $em->flush();
        return $this->redirectToRoute('front_reclamation_front_applist');
    }

}