<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2/16/2019
 * Time: 16:16
 */

namespace OrderBundle\Entity;
use Doctrine\ORM\Mapping as Orm;

/**
 * Class Cart
 * @ORM\Entity
 */

class Cart
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
     private $cartid;

   # /**
    # * @ORM\ManyToOne(targetEntity="OrderBundle\Entity\Orders")
     #* @ORM\JoinColumn(referencedColumnName="orderid")
     #*/
    # private $cartorders;
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
     private $cartclientid;
    /**
     * @Orm\Column(type="float")
     */
     private $cartsubtotal;
    /**
     * @Orm\Column(type="float")
     */
     private $cartshippingtotal;
    /**
     * @Orm\Column(type="string",length=255)
     */
     private $cartpaymenttype;
    /**
     * @Orm\Column(type="string",length=255,nullable=true)
     */
     private $cartcoupon;
    /**
     * @Orm\Column(type="float")
     */
     private $carttotal;

    /**
     * Cart constructor.
     * @param $cartid
     * @param $cartclientid
     * @param $cartsubtotal
     * @param $cartshippingtotal
     * @param $carttotal
     */
    public function __construct($cartclientid, $cartsubtotal, $cartshippingtotal, $carttotal)
    {
        $this->cartclientid = $cartclientid;
        $this->cartsubtotal = $cartsubtotal;
        $this->cartshippingtotal = $cartshippingtotal;
        $this->carttotal = $carttotal;
    }


    /**
     * @return mixed
     */
    public function getCartid()
    {
        return $this->cartid;
    }

    /**
     * @param mixed $cartid
     */
    public function setCartid($cartid)
    {
        $this->cartid = $cartid;
    }



    /**
     * @return mixed
     */
    public function getCartclientid()
    {
        return $this->cartclientid;
    }

    /**
     * @param mixed $cartclientid
     */
    public function setCartclientid($cartclientid)
    {
        $this->cartclientid = $cartclientid;
    }

    /**
     * @return mixed
     */
    public function getCartsubtotal()
    {
        return $this->cartsubtotal;
    }

    /**
     * @param mixed $cartsubtotal
     */
    public function setCartsubtotal($cartsubtotal)
    {
        $this->cartsubtotal = $cartsubtotal;
    }

    /**
     * @return mixed
     */
    public function getCartshippingtotal()
    {
        return $this->cartshippingtotal;
    }

    /**
     * @param mixed $cartshippingtotal
     */
    public function setCartshippingtotal($cartshippingtotal)
    {
        $this->cartshippingtotal = $cartshippingtotal;
    }

    /**
     * @return mixed
     */
    public function getCartpaymenttype()
    {
        return $this->cartpaymenttype;
    }

    /**
     * @param mixed $cartpaymenttype
     */
    public function setCartpaymenttype($cartpaymenttype)
    {
        $this->cartpaymenttype = $cartpaymenttype;
    }

    /**
     * @return mixed
     */
    public function getCartcoupon()
    {
        return $this->cartcoupon;
    }

    /**
     * @param mixed $cartcoupon
     */
    public function setCartcoupon($cartcoupon)
    {
        $this->cartcoupon = $cartcoupon;
    }

    /**
     * @return mixed
     */
    public function getCarttotal()
    {
        return $this->carttotal;
    }

    /**
     * @param mixed $carttotal
     */
    public function setCarttotal($carttotal)
    {
        $this->carttotal = $carttotal;
    }




}