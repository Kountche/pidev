<?php
namespace SavBundle\Controller;
use SavBundle\Entity\Appointment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class Appointment_backController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Sav/Default/index.html.twig');
    }



    public function listAction()
    {
        $em=$this->getDoctrine();
        $Appointment=$em->getRepository(@"SavBundle:Appointment")->findAll();

        return $this->render('@Sav/Reclamation_back/Appointment.html.twig',array('Appointment'=>$Appointment));
    }


    public function Appointment_confAction(Request $request,$id)
    {
        $em=$this->getDoctrine()->getManager();
        $Appointment=$em->getRepository(@"SavBundle:Appointment")->find($id);
        $Appointment->setAppointmentetat(1);
        $em->persist($Appointment);
        $em->flush();

        $message = \Swift_Message::newInstance()
            ->setSubject('Pépiniére')
            ->setFrom('cheick556@gmail.com')
            ->setTo(''.$Appointment->getAppointmentemail())
            ->setBody(
                $this->renderView(
                // app/Resources/views/Emails/registration.html.twig
                    'Default/email_app.html.twig',
                            array('Appointment'=>$Appointment)
                ),
                'text/html'
            )

        ;

        $this->get('mailer')->send($message);$this->get('session')->getFlashBag()->add(
        'success',
        'Le message qui s\'affichera est celui ci !'
    );
        return $this->redirectToRoute('appointmentlist_back');

    }

}
