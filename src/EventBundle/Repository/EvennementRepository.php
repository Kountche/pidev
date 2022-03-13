<?php

namespace EventBundle\Repository;

/**
 * EvennementRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EvennementRepository extends \Doctrine\ORM\EntityRepository
{

    public function findttby($note) {
        return $this->createQueryBuilder('e')
            ->select( 'e.nom , e.type , e.date , e.lieux , e.nbPlace , e.photo , e.description ')
            ->Where('e.nom = :search or e.type = :search or e.lieux = :search ')  //or e.nom =: searchTerm
            ->setParameter('search', $note)
            ->getQuery()
            ->getResult();
    }


    public function findBytt($indice)
    {
        $query=$this->createQueryBuilder('e')  //creer un alias sur l'entity pour pouvoir accéder a l'attribut
        ->where ('e.nom=:indice or e.lieux =:indice or e.type=:indice or e.idEvent=:indice')    // :=pays parametre nommé
        ->setParameter('indice',$indice);  //remplacer le paramétre par sa value
        //au nveau de controller
        return $query->getQuery()->getResult();

    }





}