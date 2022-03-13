<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 18/02/2019
 * Time: 09:54
 */

namespace ProductBundle\Entity;


use Doctrine\ORM\EntityRepository;
use ProductBundle\ProductBundle;

class CategoriesRepository extends EntityRepository
{
    public function findallcategories()
    {
        $query=$this->getEntityManager()
            ->createQuery("SELECT p FROM ProductBundle:Categories p ");
        return $query->getResult();

    }
    public function discount ($dicount)
    {
        $query=$this->getEntityManager()
            ->createQuery("SELECT p  FROM MarketingBundle:Promotion p where p.id=:id ")
            ->setParameter('id',$dicount);

        return $query->getResult();

    }




}