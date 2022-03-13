<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 16/02/2019
 * Time: 12:46
 */

namespace DeliveryBundle\Entity;
use Doctrine\ORM\Mapping as Orm;

/**
 * Class Delivery_deliver
 * @ORM\Entity()
 */

class Delivery_deliver
{
    /**
     * @var int
     *
     * @ORM\Column(name="Deliver_Id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $Deliver_Id;

    /**
     * @var string
     *
     * @ORM\Column(name="Deliver_Cin", type="integer", length=11)
     */
    private $Deliver_Cin;

    /**
     * @var string
     *
     * @ORM\Column(name="Deliver_Firstname", type="string", length=255)
     */
    private $Deliver_Firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="Deliver_Lastname", type="string", length=255)
     */
    private $Deliver_Lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="Deliver_Status", type="string", length=255)
     */
    private $Deliver_Status;




    /**
     * @return int
     */
    public function getIdUser()
    {
        return $this->IdUser;
    }

    /**
     * @param int $IdUser
     */
    public function setIdUser($IdUser)
    {
        $this->IdUser = $IdUser;
    }






    /**
     * @return int
     */
    public function getDeliverId()
    {
        return $this->Deliver_Id;
    }

    /**
     * @param int $Deliver_Id
     */
    public function setDeliverId($Deliver_Id)
    {
        $this->Deliver_Id = $Deliver_Id;
    }

    /**
     * @return string
     */
    public function getDeliverCin()
    {
        return $this->Deliver_Cin;
    }

    /**
     * @param string $Deliver_Cin
     */
    public function setDeliverCin($Deliver_Cin)
    {
        $this->Deliver_Cin = $Deliver_Cin;
    }

    /**
     * @return string
     */
    public function getDeliverFirstname()
    {
        return $this->Deliver_Firstname;
    }

    /**
     * @param string $Deliver_Firstname
     */
    public function setDeliverFirstname($Deliver_Firstname)
    {
        $this->Deliver_Firstname = $Deliver_Firstname;
    }

    /**
     * @return string
     */
    public function getDeliverLastname()
    {
        return $this->Deliver_Lastname;
    }

    /**
     * @param string $Deliver_Lastname
     */
    public function setDeliverLastname($Deliver_Lastname)
    {
        $this->Deliver_Lastname = $Deliver_Lastname;
    }

    /**
     * @return string
     */
    public function getDeliverStatus()
    {
        return $this->Deliver_Status;
    }

    /**
     * @param string $Deliver_Status
     */
    public function setDeliverStatus($Deliver_Status)
    {
        $this->Deliver_Status = $Deliver_Status;
    }



}
