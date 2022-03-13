<?php
/**
 * Created by PhpStorm.
 * User: servise info
 * Date: 18/02/2019
 * Time: 12:20
 */

namespace MarketingBundle\Entity;


use Doctrine\ORM\EntityRepository;

class CouponRepository extends  EntityRepository
{
    public function findByMontant($amount)
    {
        $query=$this->getEntityManager()
            ->createQuery("SELECT c FROM MarketingBundle:Coupon c  where  c.amount LIKE :amount ORDER BY
    c.id DESC")
            ->setParameter('amount','%'.$amount.'%');
        return $query->getResult();

    }
    public function findByMontantDesc()
    {
        $query=$this->getEntityManager()->createQuery("SELECT c FROM MarketingBundle:Coupon c ORDER BY c.amount DESC");
        return $query->getResult();

    }
    public function findByMontantAsc()
    {
        $query=$this->getEntityManager()->createQuery("SELECT c FROM MarketingBundle:Coupon c ORDER BY c.amount ASC");
        return $query->getResult();

    }
}