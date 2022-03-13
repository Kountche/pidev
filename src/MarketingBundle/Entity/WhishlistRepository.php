<?php
/**
 * Created by PhpStorm.
 * User: servise info
 * Date: 18/02/2019
 * Time: 12:20
 */

namespace MarketingBundle\Entity;


use Doctrine\ORM\EntityRepository;

class WhishlistRepository extends EntityRepository
{

    public function findByClient()
    {
        $query=$this->getEntityManager()->createQuery("SELECT p FROM MarketingBundle:Whishlist p  GROUP BY p.iduser ");
        return $query->getResult();
    }

    public function findByProduct($productid)
    {
        $query=$this->getEntityManager()->createQuery("SELECT p FROM MarketingBundle:Whishlist p  WHERE p.product= :productid")
            ->setParameter('productid',$productid);
        return $query->getResult();
    }
}