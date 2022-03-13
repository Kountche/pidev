<?php
/**
 * Created by PhpStorm.
 * User: servise info
 * Date: 16/02/2019
 * Time: 16:12
 */

namespace MarketingBundle\Controller;

use MarketingBundle\Form\CouponType;
use Symfony\Component\HttpFoundation\Request;
use MarketingBundle\Entity\Coupon;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class CouponController extends Controller
{
    public function ShowAction(){
        $em=$this->getDoctrine()->getManager();
        $coupon=$em->getRepository("MarketingBundle:Coupon")->findAll();

        return $this->render("@Marketing/Back/coupons.html.twig",array("coupons"=>$coupon));
    }


    public function AddCouponAction(Request $request){
        $coupon= new Coupon();
        if($request->isMethod('POST'))
        {
            $coupon->setCode($request->get('code'));
            $coupon->setAmount($request->get('amount'));
            $disc=$coupon->getAmount();
            $cod=$coupon->getCode();
            if(($disc<0)||($disc>100)){
                $msg = 'Discount invalid : Veuillez entrez un entier entre 0 et 100';
                return $this->render('@Marketing/Back/AddCoupon.html.twig',array('Message' => $msg));
            }
            if($cod>0){
                $msg = 'Code invalid ';
                return $this->render('@Marketing/Back/AddCoupon.html.twig',array('Message' => $msg));
            }
            $em=$this->getDoctrine()->getManager();
            $em->persist($coupon);
            $em->flush();
            return $this->redirectToRoute('ShowCoupons');
        }
        $msg="";
        return $this->render('@Marketing/Back/AddCoupon.html.twig',array("coupon"=>$coupon,'Message' => $msg));
    }
    public function UpdateAction(Request $request,$id){
        $em=$this->getDoctrine()->getManager();
        $coupon=$em->getRepository("MarketingBundle:Coupon")->find($id);
        $form=$this->createForm(CouponType::class,$coupon);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $disc=$form['amount']->getData();
            $cod=$form['code']->getData();
            if(($disc<0)||($disc>100)){
                $msg = 'Discount invalid : Veuillez entrez un entier entre 0 et 100';
                return $this->render('@Marketing/Back/updateCoupon.html.twig',array('form'=>$form->createView(),'Message' => $msg));
            }
            if($cod>0){
                $msg = 'Code invalid ';
                return $this->render('@Marketing/Back/updateCoupon.html.twig',array('form'=>$form->createView(),'Message' => $msg));
            }
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('ShowCoupons');
        }
        $msg="";
        return $this->render('@Marketing/Back/updateCoupon.html.twig',array('form'=>$form->createView(),'Message' => $msg));
    }
    public function DeleteAction($id){
        $em=$this->getDoctrine()->getManager();
        $coupon=$em->getRepository("MarketingBundle:Coupon")->find($id);
        $em->remove($coupon);
        $em->flush();

        return $this->redirectToRoute('ShowCoupons');
    }
    public function RechercheAction(Request $request){
        $em=$this->getDoctrine()->getManager();
        if($request->isMethod('POST')){
            $amount=$request->get('motcle');
            $coupon =$em->getRepository("MarketingBundle:Coupon")
                ->findByMontant($amount);
            return $this->render('@Marketing/Back/coupons.html.twig',array('coupons'=>$coupon));
        }
        return $this->render('@Marketing/Back/ChercherCoupon.html.twig');
    }
    public function FiltreASCAction(Request $request){
        $em=$this->getDoctrine()->getManager();

            $coupon =$em->getRepository("MarketingBundle:Coupon")
                ->findByMontantAsc();
            return $this->render('@Marketing/Back/coupons.html.twig',array('coupons'=>$coupon));
          }
    public function FiltreDESCAction(Request $request){
        $em=$this->getDoctrine()->getManager();
            $coupon =$em->getRepository("MarketingBundle:Coupon")
                ->findByMontantDesc();
            return $this->render('@Marketing/Back/coupons.html.twig',array('coupons'=>$coupon));
    }
}