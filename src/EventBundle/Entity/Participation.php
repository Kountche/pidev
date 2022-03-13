<?php

namespace EventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Participation
 *
 * @ORM\Table(name="participation")
 * @ORM\Entity(repositoryClass="EventBundle\Repository\ParticipationRepository")
 */
class Participation
{
    /**
     * @var int
     *
     * @ORM\Column(name="idparticipation", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idParticipation;

    /**
     * @ORM\ManyToOne(targetEntity="Evennement")
     * @ORM\JoinColumn(referencedColumnName="idEvent")
     */
    private $Evennement;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private $User;


    /**
     * @var float
     *
     * @ORM\Column(name="note", type="float")
     */
    private $note;




    /**
     * Get idParticipation
     *
     * @return integer
     */
    public function getIdParticipation()
    {
        return $this->idParticipation;
    }

    /**
     * Set note
     *
     * @param float $note
     *
     * @return Participation
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return float
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set evennement
     *
     * @param \EventBundle\Entity\Evennement $evennement
     *
     * @return Participation
     */
    public function setEvennement($Evennement)
    {
        $this->Evennement = $Evennement;
    }

    /**
     * Get evennement
     *
     * @return \EventBundle\Entity\Evennement
     */
    public function getEvennement()
    {
        return $this->Evennement;
    }

    /**
     * Set user
     *
     * @param \EventBundle\Entity\User $user
     *
     * @return Participation
     */
    public function setUser(\EventBundle\Entity\User $user = null)
    {
        $this->User = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \EventBundle\Entity\User
     */
    public function getUser()
    {
        return $this->User;
    }
}
