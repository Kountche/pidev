<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 16/02/2019
 * Time: 21:45
 */

namespace DeliveryBundle\Entity;
use Doctrine\ORM\Mapping as ORM;


/**
 * Class Delivery_orders
 * @ORM\Entity()
 */


class Delivery_orders
{

    /**
     * @var integer
     *
     * @ORM\Column(name="Deliveryorders_Id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $Deliveryorders_Id;

    /**
     * @return int
     */
    public function getDeliveryordersId()
    {
        return $this->Deliveryorders_Id;
    }

    /**
     * @param int $Deliveryorders_Id
     */
    public function setDeliveryordersId($Deliveryorders_Id)
    {
        $this->Deliveryorders_Id = $Deliveryorders_Id;
    }

    /**
     * @var String
     *
     * @ORM\Column(name="Date", type="string", length=255, nullable=true)
     */
    private $Date;

    /**
     * @return String
     */
    public function getDate()
    {
        return $this->Date;
    }

    /**
     * @param String $Date
     */
    public function setDate($Date)
    {
        $this->Date = $Date;
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="Amount", type="integer",  nullable=true)
     */
    private $Amount;



    /**
     * @return int
     */
    public function getAmount()
    {
        return $this->Amount;
    }

    /**
     *
     *
     * @param int $Amount
     */
    public function setAmount($Amount)
    {
        $this->Amount = $Amount;
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="longi", type="float",  nullable=true)
     */
    private $longi;

    /**
     * @return int
     */
    public function getLongi()
    {
        return $this->longi;
    }

    /**
     * @param int $longi
     */
    public function setLongi($longi)
    {
        $this->longi = $longi;
    }


    /**
     * @var integer
     *
     * @ORM\Column(name="lat", type="float",  nullable=true)
     */
    private $lat;



    /**
     * @var integer
     *
     * @ORM\Column(name="idCurrent", type="integer",  nullable=true)
     */
    private $idCurrent;






    /**
     * @var integer
     *
     * @ORM\Column(name="idCar", type="integer",  nullable=true)
     */
    private $idCar;



    /**
     * @return int
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * @param int $lat
     */
    public function setLat($lat)
    {
        $this->lat = $lat;
    }

    /**
     * @return int
     */
    public function getIdCurrent()
    {
        return $this->idCurrent;
    }

    /**
     * @param int $idCurrent
     */
    public function setIdCurrent($idCurrent)
    {
        $this->idCurrent = $idCurrent;
    }


    /**
     * @return int
     */
    public function getIdCar()
    {
        return $this->idCar;
    }

    /**
     * @param int $idCar
     */
    public function setIdCar($idCar)
    {
        $this->idCar = $idCar;
    }

    /**
     * @return int
     */








}