<?php
/**
 * Created by PhpStorm.
 * User: servise info
 * Date: 18/02/2019
 * Time: 12:20
 */

namespace MarketingBundle\Entity;


use Doctrine\ORM\EntityRepository;

class PromotionRepository extends  EntityRepository
{
    public function findByDiscount($discount)
    {
        $query=$this->getEntityManager()
            ->createQuery("SELECT c FROM MarketingBundle:Promotion c  where  c.discount LIKE :discount ORDER BY
    c.id DESC")
            ->setParameter('discount','%'.$discount.'%');
        return $query->getResult();
    }

    public function findByDiscountDesc()
    {
        $query=$this->getEntityManager()->createQuery("SELECT p FROM MarketingBundle:Promotion p ORDER BY p.discount DESC");
        return $query->getResult();
    }
    public function findByDiscountAsc()
    {
        $query=$this->getEntityManager()->createQuery("SELECT p FROM MarketingBundle:Promotion p ORDER BY p.discount ASC");
        return $query->getResult();
    }
    public function findByDateDesc()
    {
        $query=$this->getEntityManager()->createQuery("SELECT p FROM MarketingBundle:Promotion p ORDER BY p.dateD DESC");
        return $query->getResult();
    }
    public function findByDateAsc()
    {
        $query=$this->getEntityManager()->createQuery("SELECT p FROM MarketingBundle:Promotion p ORDER BY p.dateF ASC");
        return $query->getResult();
    }

    public function findbyddiscount()
    {
        $query=$this->getEntityManager()
            ->createQuery("SELECT p FROM MarketingBundle:Promotion p WHERE p.discount!=0 AND p.dateF > CURRENT_TIMESTAMP()
      ORDER BY p.discount DESC ");
        return $query->getResult();
    }
}