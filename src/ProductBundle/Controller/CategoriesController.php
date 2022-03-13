<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 16/02/2019
 * Time: 22:33
 */

namespace ProductBundle\Controller;


use CMEN\GoogleChartsBundle\GoogleCharts\Charts\BarChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\CalendarChart;
use ProductBundle\Entity\Categories;
use ProductBundle\Form\CategoriesType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;

class CategoriesController extends  Controller
{
    public function addAction(Request $request)
    {
        /** @var UploadedFile $file */

        $modeles = new Categories();
        $form = $this->createForm(CategoriesType::class, $modeles);
        $form->handleRequest($request);
        if ($form->isValid() ) {
            $em = $this->getDoctrine()->getManager();
            $file =$modeles->getCategoryImage();
            $fileName =md5(uniqid()).'.'.$file->guessExtension();


            $file->move(
                $this->getParameter(
                    'image_directory_categorie'),$fileName
            );

            $modeles->setCategoryImage($fileName);


            $em->persist($modeles);
            $em->flush();
            return $this->redirectToRoute('List2_categories');

        }

        return $this->render('@Product/Back/Categories/addcategories.html.twig',
            array('form' => $form->createView()));

    }

    public function listAction()
    {
        $em=$this->getDoctrine()->getManager();

        $categories=$em->getRepository("ProductBundle:Categories")->findAll();


        return $this->render('@Product/Back/Categories/listcategories.html.twig',array('categories'=>$categories));

    }

    public function modifyAction(Request $request)
    {
        /** @var UploadedFile $file */

        $id = $request->get('id');

        $em = $this->getDoctrine()->getManager();

        $modele = $em->getRepository("ProductBundle:Categories")->find($id);

        $form = $this->createForm(CategoriesType::class, $modele);


        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $file = $modele->getCategoryImage();
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();


            $file->move(
                $this->getParameter(
                    'image_directory_categorie'), $fileName
            );

            $modele->setCategoryImage($fileName);


            $em->persist($modele);
            $em->flush();
            return $this->redirectToRoute('List2_categories');
        }
        return $this->render('@Product/Back/Categories/modifycategories.html.twig',
            array('form' => $form->createView()));
    }

    public function deleteAction(Request $request)
    {

        $id=$request->get('id');

        $em = $this->getDoctrine()->getManager();
        $modeles=$em->getRepository("ProductBundle:Categories")->find($id);
        $image =$modeles->getCategoryImage();
        $path=$this->getParameter('image_directory').'/'.$image;
        $fs = new Filesystem();
        $fs->remove(array($path));

        $em->remove($modeles);
        $em->flush();

        return $this->redirectToRoute('List2_categories');

    }

    public function showAction()
    {
        $em=$this->getDoctrine()->getManager();

        $categories=$em->getRepository("ProductBundle:Categories")->findAll();

        return $this->render('@Product/Back/Categories/editcategories.html.twig',array('categories'=>$categories));

    }
    public function statcategoriescalendarAction()
    {
        $cal = new CalendarChart();
        $em=$this->getDoctrine()->getManager();

        $categories=$em->getRepository("ProductBundle:Products")->findAll();

        $cal->getData()->setArrayToDataTable(
            [
                [['label' => 'Date', 'type' => 'date'], ['label' => 'Attendance', 'type' => 'number']],
                [ new \DateTime('2012-03-13'), 37032 ],

            ]
        );
        $cal->getOptions()->setTitle('Red Sox Attendance');
        $cal->getOptions()->setHeight(350);
        $cal->getOptions()->setWidth(1000);
        $cal->getOptions()->getCalendar()->setCellSize(20);
        $cal->getOptions()->getCalendar()->getCellColor()->setStroke('#76a7fa');
        $cal->getOptions()->getCalendar()->getCellColor()->setStrokeOpacity(0.5);
        $cal->getOptions()->getCalendar()->getCellColor()->setStrokeWidth(1);
        $cal->getOptions()->getCalendar()->getFocusedCellColor()->setStroke('#d3362d');
        $cal->getOptions()->getCalendar()->getFocusedCellColor()->setStrokeOpacity(1);
        $cal->getOptions()->getCalendar()->getFocusedCellColor()->setStrokeWidth(1);
        $cal->getOptions()->getCalendar()->getDayOfWeekLabel()->setFontName('Times-Roman');
        $cal->getOptions()->getCalendar()->getDayOfWeekLabel()->setFontSize(12);
        $cal->getOptions()->getCalendar()->getDayOfWeekLabel()->setColor('#1a8763');
        $cal->getOptions()->getCalendar()->getDayOfWeekLabel()->setBold(true);
        $cal->getOptions()->getCalendar()->getDayOfWeekLabel()->setItalic(true);
        $cal->getOptions()->getCalendar()->setDayOfWeekRightSpace(10);
        $cal->getOptions()->getCalendar()->setDaysOfWeek('DLMMJVS');
        $cal->getOptions()->getCalendar()->getMonthLabel()->setFontName('Times-Roman');
        $cal->getOptions()->getCalendar()->getMonthLabel()->setFontSize(12);
        $cal->getOptions()->getCalendar()->getMonthLabel()->setColor('#981b48');
        $cal->getOptions()->getCalendar()->getMonthLabel()->setBold(true);
        $cal->getOptions()->getCalendar()->getMonthLabel()->setItalic(true);
        $cal->getOptions()->getCalendar()->getMonthOutlineColor()->setStroke('#981b48');
        $cal->getOptions()->getCalendar()->getMonthOutlineColor()->setStrokeOpacity(0.8);
        $cal->getOptions()->getCalendar()->getMonthOutlineColor()->setStrokeWidth(2);
        $cal->getOptions()->getCalendar()->getUnusedMonthOutlineColor()->setStroke('#bc5679');
        $cal->getOptions()->getCalendar()->getUnusedMonthOutlineColor()->setStrokeOpacity(0.8);
        $cal->getOptions()->getCalendar()->getUnusedMonthOutlineColor()->setStrokeWidth(1);
        $cal->getOptions()->getCalendar()->setUnderMonthSpace(16);
        $cal->getOptions()->getCalendar()->setUnderYearSpace(10);
        $cal->getOptions()->getCalendar()->getYearLabel()->setFontName('Times-Roman');
        $cal->getOptions()->getCalendar()->getYearLabel()->setFontSize(32);
        $cal->getOptions()->getCalendar()->getYearLabel()->setColor('#1A8763');
        $cal->getOptions()->getCalendar()->getYearLabel()->setBold(true);
        $cal->getOptions()->getCalendar()->getYearLabel()->setItalic(true);

        return $this->render('@Product/Back/Categories/calendarcategories.html.twig', array('piechart' => $cal,'cat'=>$categories));

    }
    public  function statcatAction()
    {
        $bar = new \CMEN\GoogleChartsBundle\GoogleCharts\Charts\Material\BarChart();

        $em = $this->getDoctrine()->getManager();
        $count10 = $em->getRepository("ProductBundle:Products")->countcategoies10();
        $count11 = $em->getRepository("ProductBundle:Products")->countcategoies11();
        $count12 = $em->getRepository("ProductBundle:Products")->countcategoies12();

        //var_dump($count11);

        $bar->getData()->setArrayToDataTable([
            ['City', 'Quantity'],
            ['Grimpantee', (int)$count10],
            ['Fruitiers', (int)$count11],
            ['Bambous', (int)$count12]

        ]);
        $bar->getOptions()->setTitle('Products per categories')->setColors('green');
        $bar->getOptions()->getHAxis()->setTitle('Number of products');
        $bar->getOptions()->getHAxis()->setMinValue(0);
        $bar->getOptions()->getVAxis()->setTitle('Categories');
        $bar->getOptions()->setWidth(900);
        $bar->getOptions()->setHeight(500);
        return $this->render('@Product/Back/Categories/chartcategories.html.twig', array('piechart' => $bar));
    }
    public function List2Action(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $categories=$em->getRepository("ProductBundle:Categories")->findAll();

        $paginator = $this->get('knp_paginator');

        $resultat = $paginator->paginate($categories, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            2/*limit per page*/
        );
        return $this->render('@Product/Back/Categories/anotherlistcategories.html.twig',array('categories'=>$resultat));
    }


}

