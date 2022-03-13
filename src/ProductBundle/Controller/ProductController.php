<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 16/02/2019
 * Time: 08:51
 */

namespace ProductBundle\Controller;


use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use ProductBundle\Entity\Products;
use ProductBundle\Form\ProductsType;
use ProductBundle\ProductBundle;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Test\Fixture\Entity\Shop\Product;


class ProductController  extends Controller
{


    public function sendmailbydarknight($subject,$sender,$receiver,$image,$date,$name,$discount,$long,$id)
    {
      //  $message2 = \Swift_Message::newInstance()
         //   ->embed(\Swift_Image::fromPath('mail/images/img650x250.jpg'));

/*
    $message = \Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom($sender)
            ->setTo($receiver)
            ->setBody(   $this->renderView(
            // templates/emails/registration.html.twig
                '@Product/Back/Products/email.html.twig'
            ),
                'text/html'
            );

        $this->get('mailer')->send($message);
*/


        $message = (new \Swift_Message())
            ->setContentType('text/html')
            ->setSubject($subject)
            ->setFrom($sender)
            ->setTo($receiver);
       $img = $message->embed(\Swift_Image::fromPath($image));

      $message->setBody($this->renderView('@Product/Back/Products/email.html.twig',['img' => $img,
          'date'=>$date,'name'=>$name,'dis'=>$discount,'long'=>$long,'id' =>$id]));

      return $this->get('mailer')->send($message);


    }
    public function addAction(Request $request)
    {


        /** @var UploadedFile $file */

        $modeles = new Products();
        $form = $this->createForm(ProductsType::class, $modeles);
        $form->handleRequest($request);
        if ($form->isValid() ) {
            $em = $this->getDoctrine()->getManager();

            $file =$modeles->getImage();
            $fileName =md5(uniqid()).'.'.$file->guessExtension();

            $file->move(
                $this->getParameter(
                    'image_directory'),$fileName
            );
            // $modeles->setPoductDate(new \DateTime("now"));

            // $modeles->setDate(new \DateTime($request->get('date')));

            $modeles->setImage($fileName);

            $em = $this->getDoctrine()->getManager();
            $users=$em->getRepository("AppBundle:User")->findAll();

            $date =$modeles->getDate();
            $name =$modeles->getName();
            $longdesc =$modeles->getLongdesc();
            $id = $modeles->getId();
            $dis =$modeles->getSolde();
            $discount = $em->getRepository("ProductBundle:Categories")->discount($dis);

            //var_dump($name);


            foreach ($users as $user) {

                $this->sendmailbydarknight('Newsletter about The new products', 'dalialaya4@gmail.com', $user->getEmail(), 'uploads/images/' . $fileName,$date,$name,$discount,$longdesc,$id);
            }


            $em->persist($modeles);


            $em->flush();
            return $this->redirectToRoute('List2_products');

        }

        return $this->render('@Product/Back/Products/addproduct.html.twig',
            array('form' => $form->createView()));




    }
    public function deleteAction(Request $request)
    {

        $id=$request->get('id');

        $em = $this->getDoctrine()->getManager();
        $modeles=$em->getRepository("ProductBundle:Products")->find($id);
        $image =$modeles->getImage();
        $path=$this->getParameter('image_directory').'/'.$image;
        $fs = new Filesystem();
        $fs->remove(array($path));

        $em->remove($modeles);
        $em->flush();

        return $this->redirectToRoute('List2_products');

    }

    public function listAction()
    {
        $em=$this->getDoctrine()->getManager();

        $products=$em->getRepository("ProductBundle:Products")->findAll();

        return $this->render('@Product/Back/Products/listproduct.html.twig',array('products'=>$products));

    }

    public function modifyAction(Request $request)
    {
        /** @var UploadedFile $file */

        $id = $request->get('id');

        $em = $this->getDoctrine()->getManager();

        $modele = $em->getRepository("ProductBundle:Products")->find($id);
        $form = $this->createForm(ProductsType::class, $modele);


        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $file =$modele->getImage();
            $fileName =md5(uniqid()).'.'.$file->guessExtension();


            $file->move(
                $this->getParameter(
                    'image_directory'),$fileName
            );

            // $modele->setDate(new \DateTime($request->get('date')));
            $modele->setImage($fileName);


            $em->persist($modele);
            $em->flush();
            return $this->redirectToRoute('List2_products');
        }

        return $this->render('@Product/Back/Products/modifyproduct.html.twig',
            array('form' => $form->createView()));





    }
    public function showAction()
    {
        $em=$this->getDoctrine()->getManager();

        $products=$em->getRepository("ProductBundle:Products")->findAll();

        return $this->render('@Product/Back/Products/editproduct.html.twig',array('products'=>$products));

    }

    public function showFrontAction()
    {
        //product discount
        $em3 = $this->getDoctrine()->getManager();
        $discount= $em3->getRepository("ProductBundle:Products")->findbydiscount();

        //best sellers
        $em3 = $this->getDoctrine()->getManager();
        $best= $em3->getRepository("ProductBundle:Products")->findbestsellers();


        //new products
        $em2 = $this->getDoctrine()->getManager();
        $newproduct = $em2->getRepository("ProductBundle:Products")->findnewproducts();


         //all categories
        $em1=$this->getDoctrine()->getManager();
        $categories=$em1->getRepository("ProductBundle:Categories")->findAll();

        //all products
        $em=$this->getDoctrine()->getManager();
        $products=$em->getRepository("ProductBundle:Products")->findAll();

//iheb edit
        if($this->isGranted('ROLE_USER')) {
            $id = $this->getUser()->getId();
            $em = $this->getDoctrine()->getManager();
            $orders = $em->getRepository('OrderBundle:Orders')->findBy(['clientid' => $id]);

            foreach ($orders as $order) {
                $order->setOrdersubtoatal($order->getOrderunitprice() * $order->getOrderamount());

                $em->flush();
            }

            $calcule = 0;
            foreach ($orders as $order) {
                //$calcule = 0;
                $calcule = $calcule + $order->getOrdersubtoatal();

            }
            $cart = $em->getRepository('OrderBundle:Cart')->findOneBy(['cartclientid' => $id]);

            if ($cart->getCartsubtotal() != $calcule) {
                $cart->setCartsubtotal(0);
                $em->flush();
                // $cart = $em->getRepository('OrderBundle:Cart')->find($id);
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
            $promotion=$em->getRepository("MarketingBundle:Promotion")->findbyddiscount();

            foreach ($count as $c) {
                $x = $x + 1;
            }
        }
        if($this->isGranted('ROLE_USER')) {
            return $this->render('@Product/Front/Products/home.html.twig',
                array('products'=>$products,'categories' => $categories,
                    'newproduct' => $newproduct,'best' => $best,'discount' => $discount
                //iheb edit
                    ,"orders" => $orders, 'cart' => $cart, "count" => $x, "ordersmini" => $orders
                    //edit raya
                ,'promotion' => $promotion
                ));


        }

        //rayaEdit
        $em=$this->getDoctrine()->getManager();
        $promotion=$em->getRepository("MarketingBundle:Promotion")->findbyddiscount();

        return $this->render('@Product/Front/Products/home.html.twig',
            array('products'=>$products,'categories' => $categories,
                'newproduct' => $newproduct,'best' => $best,'discount' => $discount
            //iheb edit
                ,"count"=>0
                //edit raya
            ,'promotion' => $promotion
            ));


    }
    public function showSingleProductAction($id)
    {


        $em = $this->getDoctrine()->getManager();

        $product = $em->getRepository("ProductBundle:Products")->find($id);

        $category = $em->getRepository("ProductBundle:Products")->findlistproduit($product->getCategory());

        $cat = $em->getRepository("ProductBundle:Categories")->findallcategories();

        //iheb edit
        $x = 0;
        if($this->isGranted('ROLE_USER')) {
            $id = $this->getUser()->getId();
            $em = $this->getDoctrine()->getManager();
            $orders = $em->getRepository('OrderBundle:Orders')->findBy(['clientid' => $id]);

            foreach ($orders as $order) {
                $order->setOrdersubtoatal($order->getOrderunitprice() * $order->getOrderamount());

                $em->flush();
            }
            $cart = $em->getRepository('OrderBundle:Cart')->findOneBy(['cartclientid' => $id]);
            $calcule = 0;
            foreach ($orders as $order) {
               // $calcule = 0;
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
        }
        return $this->render('@Product/Front/Products/productdetail.html.twig',array('product'=>$product,
            'test' =>$category,'all' => $cat
        //iheb edit
            ,"orders"=>$orders,'cart'=>$cart,"count"=>$x,"ordersmini"=>$orders
        ));

    }

    public function shopProductAction(Request $request)
    {
        $id = $request->get('id');
        $pr =$request->get('price2');

        $pos = strpos($pr, '$', 0);
        $espace1 = strpos($pr, ' ', 0);
        $length =strlen($pr);
        if($pr==null)
        {
            $offset=0;
        }
        else
        {
            $offset=1;
        }

        $pos2 = strpos($pr, '$', $offset);

        $input= substr($pr, $pos+1, $espace1-1);
       $input2= substr($pr, $pos2+1, $length);




        $em = $this->getDoctrine()->getManager();
        $categorie = $em->getRepository("ProductBundle:Products")->findproductbycategorie($id);
        $gim = $em->getRepository("ProductBundle:Products")->groupingbygim();
        $fruit = $em->getRepository("ProductBundle:Products")->groupingbfruit();
        $bam = $em->getRepository("ProductBundle:Products")->groupingbybam();


//sort by
                $categoriepriceasc = $em->getRepository("ProductBundle:Products")->findpricebyasc($id);
                $categorie2pricedesc = $em->getRepository("ProductBundle:Products")->findpricebydesc($id);
                $categorie3namedesc = $em->getRepository("ProductBundle:Products")->findnamebydesc($id);
                $categorie4nameasc = $em->getRepository("ProductBundle:Products")->findnamebyasc($id);
//nubmer of products shown

       $two =  $em->getRepository("ProductBundle:Products")->showfist2($id);
       $four =  $em->getRepository("ProductBundle:Products")->showfist4($id);
       $six =   $em->getRepository("ProductBundle:Products")->showfist6($id);


            //echo $pr;
            // echo '           ';
            // echo $input;
            // echo '     seconde one      ';
            // echo $input2;


          //  var_dump($resultat);


        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */

        $paginator = $this->get('knp_paginator');
        if($request->isMethod('post')) {
            $em = $this->getDoctrine()->getManager();
            $resultat1 = $em->getRepository("ProductBundle:Products")->filtering($input,$input2,$id);
            $resultat = $paginator->paginate($resultat1, /* query NOT result */
                $request->query->getInt('page', 1)/*page number*/,
                2/*limit per page*/
            );
        }
        else
        {
            $resultat = $paginator->paginate($categorie, /* query NOT result */
                $request->query->getInt('page', 1)/*page number*/,
                2/*limit per page*/
            );

        }

        return $this->render('@Product/Front/Products/shoplist.html.twig',
            array('categories'=>$resultat,'categories2' => $categoriepriceasc,'categorie3' => $categorie2pricedesc
                ,'categorie4'=>$categorie4nameasc,'categorie5' =>$categorie3namedesc,'cat'=>$categorie,
                'two' =>$two,'four'=>$four,'six'=>$six,'gim' =>$gim,'fr'=>$fruit,'bam' =>$bam
             ));
    }

    public function StatproductAction()
    {

        $em = $this->getDoctrine()->getManager();
        $countall = $em->getRepository("ProductBundle:Products")->countallproducts();
        $countinstock = $em->getRepository("ProductBundle:Products")->countstockproducts();

       // var_dump($countall);
       // var_dump($countinstock);


        $pieChart = new PieChart();
        $pieChart->getData()->setArrayToDataTable(
            [['Task', 'Hours per Day'],
                ['Out stock',   (int) ($countinstock*100)/$countall ],
                ['In stock',      (int)(100 -(($countinstock*100)/$countall) ) ]

            ]
        );
        $pieChart->getOptions()->setTitle('Available product stock');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);

        return $this->render('@Product/Back/Products/statproduct.html.twig', array('piechart' => $pieChart));


    }
    public function testAction( Request $request)
    {

        $voiture = new Products();
        $em = $this->getDoctrine()->getManager();
        $voitures=$em->getRepository('ProductBundle:Products')->findAll();
        $Form = $this->createForm(ProductsType::class, $voiture);
        $Form->handleRequest($request);

        if($request->isXmlHttpRequest()) {

            $serializer = new Serializer(array(new ObjectNormalizer()));

           // $voitures = $em->getRepository('ProductBundle:Products')
           //     ->findBy(array('price' => $request->get('price')));

            if ($request->get('type')==1) {
                $sort = $em->getRepository('ProductBundle:Products')->findpricebydesc();
                $data = $serializer->normalize($sort);

                // var_dump($data);

                return new JsonResponse($data);
            }
        }

        return $this->render(
            'ProductBundle:Front/Products:ajaxproduct.html.twig',
            array("voitures" => $voitures,
                "form" => $Form->createView()));
    }
    function List2Action(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $products=$em->getRepository("ProductBundle:Products")->findAll();

        $paginator = $this->get('knp_paginator');

        $resultat = $paginator->paginate($products, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            4/*limit per page*/
        );
        return $this->render('@Product/Back/Products/anotherlistproduct.html.twig',array('products'=>$resultat));

    }








}