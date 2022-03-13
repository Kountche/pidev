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
 * Class Delivery_car
 * @ORM\Entity(repositoryClass="DeliveryBundle\Repository\Delivery_carRepository")
 */


class Delivery_car
{

    /**
     * @var int
     *
     * @ORM\Column(name="Car_Id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $Car_Id;

    /**
     * @var string
     *
     * @ORM\Column(name="Matricule", type="string", length=255)
     */
    private $Matricule;



    /**
     * @var string
     *
     * @ORM\Column(name="Type", type="string", length=255)
     */
    private $Type;

    /**
     * @var string
     *
     * @ORM\Column(name="Status", type="string", length=255)
     */
    private $Status;



    /**
     * @var int
     *
     * @ORM\Column(name="Id_User", type="integer")
     */
    private $IdUser;

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
    public function getCar_Id()
    {
        return $this->Car_Id;
    }

    /**
     * @param int $Car_Id
     */
    public function setCar_Id($Car_Id)
    {
        $this->Car_Id = $Car_Id;
    }
    /**
     * @return string
     */
    public function getMatricule()
    {
        return $this->Matricule;
    }

    /**
     * @param string $Matricule
     */
    public function setMatricule($Matricule)
    {
        $this->Matricule = $Matricule;
    }



    /**
     * @return string
     */
    public function getType()
    {
        return $this->Type;
    }

    /**
     * @param string $Type
     */
    public function setType($Type)
    {
        $this->Type = $Type;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->Status;
    }

    /**
     * @param string $Status
     */
    public function setStatus($Status)
    {
        $this->Status = $Status;
    }



}