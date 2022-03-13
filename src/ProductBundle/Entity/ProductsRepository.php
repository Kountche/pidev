<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 18/02/2019
 * Time: 09:52
 */

namespace ProductBundle\Entity;


use Doctrine\ORM\EntityRepository;

class ProductsRepository  extends EntityRepository
{
    public function findproductbycategorie($category)
    {
        $query = $this->getEntityManager()
            ->createQuery("SELECT p FROM ProductBundle:Products p where
              p.category=:category and p.status='Published'")
            ->setParameter('category', $category);
        return $query->getResult();

    }

    public function findpricebydesc($category)
    {
        $query = $this->getEntityManager()
            ->createQuery("SELECT p FROM ProductBundle:Products p where
              p.category=:category and p.status='Published'  order by p.price desc ")
            ->setParameter('category', $category);
        return $query->getResult();





    }

    public function countallproducts()
    {
        return $this->createQueryBuilder('p')
            ->select('COUNT(p.id)')
            ->getQuery()
            ->getSingleScalarResult();


    }
    public function countstockproducts()
    {
        return $this->createQueryBuilder('p')
            ->select('COUNT(p.id)')
            ->where('p.stock=0')
            ->getQuery()
            ->getSingleScalarResult();


    }

    public function countcategoies11()
    {
            return $this->createQueryBuilder('c')
            ->select('COUNT(c.id)')
            ->where('c.category=11')
            ->getQuery()
            ->getSingleScalarResult();


    }
    public function countcategoies10()
    {
        return $this->createQueryBuilder('c')
            ->select('COUNT(c.id)')
            ->where('c.category=10')
            ->getQuery()
            ->getSingleScalarResult();


    }
    public function countcategoies12()
    {
        return $this->createQueryBuilder('c')
            ->select('COUNT(c.id)')
            ->where('c.category=12')
            ->getQuery()
            ->getSingleScalarResult();


    }

    public function findpricebyasc($category)
    {
        $query = $this->getEntityManager()
            ->createQuery("SELECT p FROM ProductBundle:Products p  where
              p.category=:category and p.status='Published' order by p.price asc ")
            ->setParameter('category', $category);
        return $query->getResult();

    }

    public function findnamebydesc($category)
    {
        $query = $this->getEntityManager()
            ->createQuery("SELECT p FROM ProductBundle:Products p  where p.category=:category and 
   p.status='Published'order by p.name desc ")

            ->setParameter('category', $category);
        return $query->getResult();

    }

    public function findnamebyasc($category)
    {
        $query = $this->getEntityManager()
            ->createQuery("SELECT p FROM ProductBundle:Products p 
        where p.category=:category and 
   p.status='Published' order by p.name asc ")
            ->setParameter('category', $category);

        return $query->getResult();

    }

    public function showfist2($category)
    {
        $query = $this->getEntityManager()
            ->createQuery("SELECT p FROM ProductBundle:Products p  where p.category=:category and 
   p.status='Published' ")
            ->setMaxResults(2)

            ->setParameter('category', $category);
        return $query->getResult();

    }

    public function showfist4($category)
    {
        $query = $this->getEntityManager()
            ->createQuery("SELECT p FROM ProductBundle:Products p  where p.category=:category and 
   p.status='Published' ")
            ->setMaxResults(4)

            ->setParameter('category', $category);
        return $query->getResult();

    }
    public function showfist6($category)
    {
        $query = $this->getEntityManager()
            ->createQuery("SELECT p FROM ProductBundle:Products p  where p.category=:category and 
   p.status='Published' ")
            ->setMaxResults(6)
            ->setParameter('category', $category);
        return $query->getResult();

    }
    public function filtering($min,$max,$category)
    {
        $query = $this->getEntityManager()
            ->createQuery("SELECT p FROM ProductBundle:Products p  
            where p.category=:category and p.status='Published'  and p.price
            between :price1 and :price2")
            ->setParameter('price1', $min)
            ->setParameter('category', $category)
            ->setParameter('price2',$max);
        return $query->getResult();

    }
    public  function groupingbygim()
    {
        $query=$this->getEntityManager()
            ->createQuery("SELECT p FROM ProductBundle:Products p WHERE p.category=10");
        return $query->getResult();
    }
    public  function groupingbfruit()
    {
        $query=$this->getEntityManager()
            ->createQuery("SELECT p FROM ProductBundle:Products p WHERE p.category=11");
        return $query->getResult();
    }
    public  function groupingbybam()
    {
        $query=$this->getEntityManager()
            ->createQuery("SELECT p FROM ProductBundle:Products p WHERE p.category=12");
        return $query->getResult();
    }




    public function findnewproducts()
    {
        $query=$this->getEntityManager()
            ->createQuery("SELECT p FROM ProductBundle:Products p where
              p.date > = CURRENT_DATE()");
        return $query->getResult();

    }
    public function findbestsellers()
    {
        $query=$this->getEntityManager()
            ->createQuery("SELECT p FROM ProductBundle:Products p where
              p.stock=0");
        return $query->getResult();

    }
    public function findbydiscount()
    {
        $query=$this->getEntityManager()
            ->createQuery("SELECT p FROM ProductBundle:Products p JOIN p.solde a WHERE a.discount!=0
      ORDER BY a.discount DESC ");
        return $query->getResult();
    }

    public function findlistproduit($id)
    {
        $query=$this->getEntityManager()
            ->createQuery("SELECT p FROM ProductBundle:Products p where p.category=:category and p.status='Published'
       ")
            ->setParameter('category', $id);

        return $query->getResult();
    }

}