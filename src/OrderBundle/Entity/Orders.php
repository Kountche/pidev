<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2/16/2019
 * Time: 15:28
 */

namespace OrderBundle\Entity;
use Doctrine\ORM\Mapping as Orm;

/**
 * Class Orders
 * @ORM\Entity
 */
class Orders
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $orderid;
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private $clientid;
    /**
     * @ORM\ManyToOne(targetEntity="ProductBundle\Entity\Products")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private $productid;
    /**
     * @ORM\ManyToOne(targetEntity="OrderBundle\Entity\Cart")
     * @ORM\JoinColumn(referencedColumnName="cartid")
     */
    private $cartid;
    /**
     * @Orm\Column(type="string",length=255,nullable=true)
     */
    private $sellerid;
    /**
     * @Orm\Column(type="integer")
     */
    private $orderamount;
    /**
     * @Orm\Column(type="float")
     */
    private $orderunitprice;
    /**
     * @Orm\Column(type="float")
     */
    private $ordersubtoatal;
    /**
     * @Orm\Column(type="float")
     */
    private $ordertotal;
    /**
     * @Orm\Column(type="string",length=255,nullable=true)
     */
    private $ordershippingtype;
    /**
     * @Orm\Column(type="float",nullable=true)
     */
    private $ordershippingprice;
    /**
     * @Orm\Column(type="integer",nullable=true)
     */
    private $ordercheck;
    /**
     * @Orm\Column(type="integer",nullable=true)
     */
    private $orderstate;
    /**
     * @Orm\Column(type="datetime",nullable=true)
     */
    private $orderdate;

    /**
     * Orders constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getOrderid()
    {
        return $this->orderid;
    }

    /**
     * @param mixed $orderid
     */
    public function setOrderid($orderid)
    {
        $this->orderid = $orderid;
    }

    /**
     * @return mixed
     */
    public function getClientid()
    {
        return $this->clientid;
    }

    /**
     * @param mixed $clientid
     */
    public function setClientid($clientid)
    {
        $this->clientid = $clientid;
    }

    /**
     * @return mixed
     */
    public function getProductid()
    {
        return $this->productid;
    }

    /**
     * @param mixed $productid
     */
    public function setProductid($productid)
    {
        $this->productid = $productid;
    }

    /**
     * @return mixed
     */
    public function getSellerid()
    {
        return $this->sellerid;
    }

    /**
     * @param mixed $sellerid
     */
    public function setSellerid($sellerid)
    {
        $this->sellerid = $sellerid;
    }

    /**
     * @return mixed
     */
    public function getOrderamount()
    {
        return $this->orderamount;
    }

    /**
     * @param mixed $orderamount
     */
    public function setOrderamount($orderamount)
    {
        $this->orderamount = $orderamount;
    }

    /**
     * @return mixed
     */
    public function getOrderunitprice()
    {
        return $this->orderunitprice;
    }

    /**
     * @param mixed $orderunitprice
     */
    public function setOrderunitprice($orderunitprice)
    {
        $this->orderunitprice = $orderunitprice;
    }

    /**
     * @return mixed
     */
    public function getOrdersubtoatal()
    {
        return $this->ordersubtoatal;
    }

    /**
     * @param mixed $ordersubtoatal
     */
    public function setOrdersubtoatal($ordersubtoatal)
    {
        $this->ordersubtoatal = $ordersubtoatal;
    }

    /**
     * @return mixed
     */
    public function getOrdertotal()
    {
        return $this->ordertotal;
    }

    /**
     * @param mixed $ordertotal
     */
    public function setOrdertotal($ordertotal)
    {
        $this->ordertotal = $ordertotal;
    }

    /**
     * @return mixed
     */
    public function getOrdershippingtype()
    {
        return $this->ordershippingtype;
    }

    /**
     * @param mixed $ordershippingtype
     */
    public function setOrdershippingtype($ordershippingtype)
    {
        $this->ordershippingtype = $ordershippingtype;
    }

    /**
     * @return mixed
     */
    public function getOrdershippingprice()
    {
        return $this->ordershippingprice;
    }

    /**
     * @param mixed $ordershippingprice
     */
    public function setOrdershippingprice($ordershippingprice)
    {
        $this->ordershippingprice = $ordershippingprice;
    }

    /**
     * @return mixed
     */
    public function getOrdercheck()
    {
        return $this->ordercheck;
    }

    /**
     * @param mixed $ordercheck
     */
    public function setOrdercheck($ordercheck)
    {
        $this->ordercheck = $ordercheck;
    }

    /**
     * @return mixed
     */
    public function getOrderstate()
    {
        return $this->orderstate;
    }

    /**
     * @param mixed $orderstate
     */
    public function setOrderstate($orderstate)
    {
        $this->orderstate = $orderstate;
    }

    /**
     * @return mixed
     */
    public function getOrderdate()
    {
        return $this->orderdate;
    }

    /**
     * @param mixed $orderdate
     */
    public function setOrderdate($orderdate)
    {
        $this->orderdate = $orderdate;
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







}