<?php
namespace SavBundle\Controller;
use SavBundle\Entity\Claims;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class Reclamation_backController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Sav/Default/index.html.twig');
    }



    public function list_backAction()
    {
        $em=$this->getDoctrine();
        $claim=$em->getRepository(@"SavBundle:Claims")->findAll();

        return $this->render('@Sav/Reclamation_back/Reclamation.html.twig',array('claim'=>$claim));
    }


    public function Reclamation_traiterAction(Request $request,$id)
    {


        $em=$this->getDoctrine()->getManager();
        $model=$em->getRepository(@"SavBundle:Claims")->find($id);
        $model->setClaimEtat(1);
        $em->persist($model);
        $em->flush();

        $message = \Swift_Message::newInstance()
            ->setSubject('Pépiniére')
            ->setFrom('cheick556@gmail.com')
            ->setTo(''.$model->getClaimEmail())
            ->setBody(
                $this->renderView(
                // app/Resources/views/Emails/registration.html.twig
                    'Default/email.html.twig',

                    array('model'=>$model)

                ),
                'text/html'
            )

        ;

        $this->get('mailer')->send($message);$this->get('session')->getFlashBag()->add(
        'success',
        'Le message qui s\'affichera est celui ci !'
    );
        return $this->redirectToRoute('front_reclamation_back');

    }



    public function Envoyer_mailAction(Request $request,$id)
    {
        $msg = $request->get("message");
        $em = $this->getDoctrine()->getManager();
        $model = $em->getRepository(@"SavBundle:Claims")->find($id);





            $message = \Swift_Message::newInstance()
                ->setSubject('Pépiniére')
                ->setFrom('cheick556@gmail.com')
                ->setTo('' . $model->getClaimEmail())
                ->setBody('' . $msg


                );

            $this->get('mailer')->send($message);
            $this->get('session')->getFlashBag()->add(
                'success',
                'Le message qui s\'affichera est celui ci !'
            );


            return $this->redirectToRoute('front_reclamation_back');

    }
}
