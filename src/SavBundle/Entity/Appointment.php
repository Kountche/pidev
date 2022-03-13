<?php
namespace SavBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Appointment")
 */

class Appointment
{

    /**
     * @ORM\GeneratedValue
     * @ORM\Id
     * @ORM\column(type="integer")
     */
    private $appointmentid;

    /**
     * @ORM\column(type="integer" )
     */
    private $appointmentuserid;

    /**
     * @ORM\column(type="string" ,length=255)
     */
    private $appointmentusername;
    /**
     * @ORM\column(type="string" ,length=255)
     */
    private $appointmenttime;
    /**
     * @ORM\column(type="datetime" )
     */
    private $appointmentdate;
    /**
     * @ORM\column(type="integer" )
     */
    private $Appointmentetat;

    /**
     * @ORM\column(type="string" ,length=255)
     */
    private $appointmentmotif;

    /**
     * @ORM\column(type="string" ,length=255)
     */
    private $appointmentemail;

    /**
     * @return mixed
     */
    public function getAppointmentid()
    {
        return $this->appointmentid;
    }

    /**
     * @param mixed $appointmentid
     */
    public function setAppointmentid($appointmentid)
    {
        $this->appointmentid = $appointmentid;
    }

    /**
     * @return mixed
     */
    public function getAppointmentuserid()
    {
        return $this->appointmentuserid;
    }

    /**
     * @param mixed $appointmentuserid
     */
    public function setAppointmentuserid($appointmentuserid)
    {
        $this->appointmentuserid = $appointmentuserid;
    }

    /**
     * @return mixed
     */
    public function getAppointmentusername()
    {
        return $this->appointmentusername;
    }

    /**
     * @param mixed $appointmentusername
     */
    public function setAppointmentusername($appointmentusername)
    {
        $this->appointmentusername = $appointmentusername;
    }

    /**
     * @return mixed
     */
    public function getAppointmenttime()
    {
        return $this->appointmenttime;
    }

    /**
     * @param mixed $appointmenttime
     */
    public function setAppointmenttime($appointmenttime)
    {
        $this->appointmenttime = $appointmenttime;
    }

    /**
     * @return mixed
     */
    public function getAppointmentdate()
    {
        return $this->appointmentdate;
    }

    /**
     * @param mixed $appointmentdate
     */
    public function setAppointmentdate($appointmentdate)
    {
        $this->appointmentdate = $appointmentdate;
    }

    /**
     * @return mixed
     */
    public function getAppointmentetat()
    {
        return $this->Appointmentetat;
    }

    /**
     * @param mixed $Appointmentetat
     */
    public function setAppointmentetat($Appointmentetat)
    {
        $this->Appointmentetat = $Appointmentetat;
    }

    /**
     * @return mixed
     */
    public function getAppointmentmotif()
    {
        return $this->appointmentmotif;
    }

    /**
     * @param mixed $appointmentmotif
     */
    public function setAppointmentmotif($appointmentmotif)
    {
        $this->appointmentmotif = $appointmentmotif;
    }

    /**
     * @return mixed
     */
    public function getAppointmentemail()
    {
        return $this->appointmentemail;
    }

    /**
     * @param mixed $appointmentemail
     */
    public function setAppointmentemail($appointmentemail)
    {
        $this->appointmentemail = $appointmentemail;
    }


}