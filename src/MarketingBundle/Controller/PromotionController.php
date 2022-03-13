<?php
/**
 * Created by PhpStorm.
 * User: servise info
 * Date: 16/02/2019
 * Time: 16:11
 */

namespace MarketingBundle\Controller;

use MarketingBundle\Form\PromotionType;
use Symfony\Component\HttpFoundation\Request;
use MarketingBundle\Entity\Promotion;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use MarketingBundle\Entity\Mail;


class PromotionController extends Controller
{
    public function ShowAction(){
        $em=$this->getDoctrine()->getManager();
        $promotion=$em->getRepository("MarketingBundle:Promotion")->findAll();

        return $this->render("@Marketing/Back/promotion.html.twig",array("promotions"=>$promotion));
    }


    public function AddAction(Request $request){
        $promotion=new Promotion();
        $datej=new \DateTime('now');
        $datej2=$datej->format('Y-m-d');

        if($request->isMethod('POST')){

            $promotion->setDiscount($request->get('discount'));
            $promotion->setDateD(new \DateTime($request->get('dateD')));
            $promotion->setDateF(new \DateTime($request->get('dateF')));
            $disc=$promotion->getDiscount();
            $date1=$promotion->getDateD();
            $dated=$date1->format('Y-m-d');
            $date2=$promotion->getDateF();
            $datef=$date2->format('Y-m-d');
            if(($dated<$datej2)||($datef<$datej2)){
                $msg = 'date invalide : La date doit ètre supérieure ou égale à la date du jour';
                return $this->render('@Marketing/Back/AddPromotion.html.twig',array('Message' => $msg));

            }
            if ($datef<=$dated){
                $msg = 'date invalide :la date de fin  doit ètre supérieure à la date de début';
                return $this->render('@Marketing/Back/AddPromotion.html.twig',array('Message' => $msg));
            }
            if(($disc<0)||($disc>100)){
                $msg = 'Discount invalid : Veuillez entrez un entier entre 0 et 100';
                return $this->render('@Marketing/Back/AddPromotion.html.twig',array('Message' => $msg));

            }
            $em=$this->getDoctrine()->getManager();
            $em->persist($promotion);
            $em->flush();

            //$mail->setEmail($request->get('email'));
            //$mail->setMessage($request->get('msg'));
            $message = \Swift_Message::newInstance()
                ->setSubject('C les promos')
                ->setFrom('qtcreator6@gmail.com')
                ->setTo('raya.nouicer@esprit.tn')
                ->setBody(
                    $this->renderView(
                        '@Marketing/Back/promo.html.twig'
                    ),
                    'text/html'
                );
            $this->get('mailer')->send($message);

            return $this->redirectToRoute("showPromotions");
        }
        $msg=" ";
        return $this->render('@Marketing/Back/AddPromotion.html.twig',array('Message' => $msg));
    }

    public function DeleteAction($id){
        $em=$this->getDoctrine()->getManager();
        $promotion=$em->getRepository("MarketingBundle:Promotion")->find($id);
        $em->remove($promotion);
        $em->flush();

        return $this->redirectToRoute('showPromotions');
    }

    public function UpdateAction(Request $request,$id){
        $em=$this->getDoctrine()->getManager();
        $promotion=$em->getRepository("MarketingBundle:Promotion")->find($id);
        $form=$this->createForm(PromotionType::class,$promotion);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $date1=$form['dateD']->getData();
            $dated=$date1->format('Y-m-d');
            $date2=$form['dateF']->getData();
            $datef=$date2->format('Y-m-d');
            $disc=$form['discount']->getData();

            if ($datef<=$dated){
                $msg = 'date invalide :la date de fin  doit ètre supérieure à la date de début';
                return $this->render('@Marketing/Back/updatePromotion.html.twig',array('form'=>$form->createView(),'Message' => $msg));
            }
            if(($disc<0)||($disc>100)){
                $msg = 'Discount invalid : Veuillez entrez un entier entre 0 et 100';
                return $this->render('@Marketing/Back/updatePromotion.html.twig',array('form'=>$form->createView(),'Message' => $msg));
            }
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('showPromotions');
        }
        $msg="";
        return $this->render('@Marketing/Back/updatePromotion.html.twig',array('form'=>$form->createView(),'Message' => $msg));
    }

    public function RechercheAction(Request $request){
        $em=$this->getDoctrine()->getManager();
        if($request->isMethod('POST')){
            $discount=$request->get('motcle');
            $promortion =$em->getRepository("MarketingBundle:Promotion")
                ->findByDiscount($discount);
        }
        else {
            $promortion =$em->getRepository("MarketingBundle:Promotion")
                ->findAll();
        }
        return $this->render('@Marketing/Back/promotion.html.twig',array('promotions'=>$promortion));

    }
    public function FiltreDiscountASCAction(){
        $em=$this->getDoctrine()->getManager();

        $promotion =$em->getRepository("MarketingBundle:Promotion")
            ->findByDiscountAsc();
        return $this->render('@Marketing/Back/promotion.html.twig',array('promotions'=>$promotion));
    }
    public function FiltreDiscountDESCAction(){
        $em=$this->getDoctrine()->getManager();

        $promotion =$em->getRepository("MarketingBundle:Promotion")
            ->findByDiscountDesc();
        return $this->render('@Marketing/Back/promotion.html.twig',array('promotions'=>$promotion));
    }
    public function FiltreDateASCAction(){
        $em=$this->getDoctrine()->getManager();

        $promotion =$em->getRepository("MarketingBundle:Promotion")
            ->findByDateAsc();
        return $this->render('@Marketing/Back/promotion.html.twig',array('promotions'=>$promotion));
    }


    public function FiltreDateDESCAction(){
        $em=$this->getDoctrine()->getManager();

        $promotion =$em->getRepository("MarketingBundle:Promotion")
            ->findByDateDesc();
        return $this->render('@Marketing/Back/promotion.html.twig',array('promotions'=>$promotion));
    }
    public function sendEmailAction()
    {
        $name = 'Test';
        $mailer = $this->get('mailer');
        $message = $mailer->createMessage()
            ->setSubject('Ciao')
            ->setFrom('send@example.com')
            ->setTo('recipient@example.com')
            ->setBody($this->renderView('dashboard/email.html.twig', array('name' => $name)), 'text/html');
        $mailer->send($message);
        return $this->redirectToRoute('dashboard');
    }
    public function sendNotification(Request $request)
    {
        $manager = $this->get('mgilet.notification');
        $notif = $manager->createNotification('Hello world!');
        $notif->setMessage('This a notification.');
        $notif->setLink('https://symfony.com/');
        // or the one-line method :
        // $manager->createNotification('Notification subject', 'Some random text', 'https://google.fr/');

        // you can add a notification to a list of entities
        // the third parameter `$flush` allows you to directly flush the entities
        $manager->addNotification(array($this->getUser()), $notif, true);

    }
}