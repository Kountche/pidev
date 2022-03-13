<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 01/11/2018
 * Time: 12:13
 */

namespace esprit\ParcBundle\Entity;


use Doctrine\ORM\EntityRepository;

class OrderRepository extends EntityRepository
{
    public function findByCart($cartid)
    {
        $query=$this->createQueryBuilder('m')
            ->where('m.cartid=:cartid')
            ->setParameter('cartid',$cartid);
        return $query->getQuery()->getResult();
    }

}