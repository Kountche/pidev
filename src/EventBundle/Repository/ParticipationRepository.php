<?php

namespace EventBundle\Repository;


/**
 * ParticipationRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ParticipationRepository extends \Doctrine\ORM\EntityRepository
{

    /*public function findByEU($event)
    {
        $query=$this->getEntityManager()
            ->createQuery ("SELECT e FROM EventBundle:Participation e where e.Evennement = 5 ");
           // ->setParameter('event',$event);
        return $query->getResult();
    }*/


    public function findByCount()
    {
       /* $query=$this->getEntityManager()
            ->createQuery ("SELECT e.note , count(*) e FROM EventBundle:Participation Group by note");
        return $query->getResult();*/

    }


    public function getNb() {


        /*return $this->createQueryBuilder('p')
            ->select('p.note , COUNT(1) as id ')
            ->groupBy('p.note')
            ->getQuery()
            ->getResult();*/

        return $this->createQueryBuilder('p')
            ->select( 'e.nom , e.type , e.date , e.dateFin , e.lieux , e.nbPlace , e.photo , e.description , p.note , IDENTITY(p.User) as User , IDENTITY(p.Evennement) as Evennement , AVG(p.note) as moyenne , COUNT(p.Evennement) as id ')
            ->leftJoin('p.Evennement', 'e','with', 'e.idEvent = p.Evennement')
            ->groupBy('p.Evennement')
            ->getQuery()
            ->getResult();
    }



    public function Join() {

        return $this->createQueryBuilder('p')
            ->select( 'e.nom , e.type , e.date , e.dateFin , e.lieux , e.nbPlace , e.photo , e.description, p.note , p.idParticipation , IDENTITY(p.User) as User , IDENTITY(p.Evennement) as Evennement , (p.note) as moyenne , (p.Evennement) as id ')
            ->leftJoin('p.Evennement', 'e','with', 'e.idEvent = p.Evennement')
            ->getQuery()
            ->getResult();
    }



    public function findttby($note) {
        return $this->createQueryBuilder('p')
            ->select( 'e.nom , e.type , e.date , e.dateFin , e.lieux , e.nbPlace , e.photo , e.description , p.note , IDENTITY(p.Evennement) as Evennement , (p.note) as moyenne , (p.Evennement) as id ')
            ->leftJoin('p.Evennement', 'e','with', 'e.idEvent = p.Evennement')
            ->Where('e.nom = :search or e.type = :search or e.lieux = :search ')  //or e.nom =: searchTerm
            ->setParameter('search', $note)
            ->getQuery()
            ->getResult();
    }

/*SELECT `note` FROM `participation` WHERE idparticipation = 16

    public function findpt($id) {
        return $this->createQueryBuilder('p')
            ->select( 'p.note')
            ->Where('p.idParticipation = :search')  //or e.nom =: searchTerm
            ->setParameter('search', $id)
            ->getQuery()
            ->getResult();
    }*/


    public function findpt($id)
    {
        $query=$this->getEntityManager()
            ->createQuery ("Select p.note FROM EventBundle:Participation p where p.idParticipation=:part")
            ->setParameter('part',$id);
        return $query->getResult();
    }





}