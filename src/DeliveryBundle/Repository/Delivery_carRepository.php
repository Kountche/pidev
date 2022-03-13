<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 16/02/2019
 * Time: 23:28
 */

namespace DeliveryBundle\Repository;
use Doctrine\ORM\EntityRepository ;


class Delivery_carRepository extends EntityRepository
{





    public function search($matricule)

    {
        $query = $this->getEntityManager()->createQuery(

            "select m from  DeliveryBundle:Delivery_car m WHERE m.Matricule like :Matricule"

        )->setParameter('Matricule','%'.$matricule.'%');

        return $query->getResult();
    }







}