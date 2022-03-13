<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 16/02/2019
 * Time: 10:53
 */

namespace ProductBundle\Entity;
use Doctrine\ORM\Mapping as Orm;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;



/**
 * Class Products
 * @ORM\Entity(repositoryClass="ProductBundle\Entity\ProductsRepository")
 * @UniqueEntity("sku",message="This reference already exists")
 */
class Products
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Orm\Column(type="string",length=255)
     */
    private $sku;

    /**
     * @Orm\Column(type="float")
     */
    private $price;

    /**
     * @Orm\Column(type="string",length=255)
     */
    private $name;

    /**
     * @Orm\Column(type="string",length=255)
     */
    private $shortdesc;

    /**
     * @Orm\Column(type="string",length=255)
     */
    private $longdesc;

    /**
     * @var  string
     * @Assert\NotBlank(message="please insert your image")
     * @Assert\Image()
     * @Orm\Column(type="string",length=255)
     */
    private $image;



    /**
     * @ORM\ManyToOne(targetEntity="Categories")
     * @ORM\JoinColumn(referencedColumnName="id")
     */


    private $category;


    /**
     * @ORM\ManyToOne(targetEntity="MarketingBundle\Entity\Promotion")
     * @ORM\JoinColumn(referencedColumnName="id")
     */


    private $solde;

    /**
     * @return mixed
     */
    public function getSolde()
    {
        return $this->solde;
    }

    /**
     * @param mixed $solde
     */
    public function setSolde($solde)
    {
        $this->solde = $solde;
    }


    /**
     * @Orm\Column(type="integer")
     */
    private $stock;

    /**
     * @ORM\Column(type="date")
     */


    private $date;





    /**
     * @Orm\Column(type="string",length=255)
     */
    private $status;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * @param mixed $sku
     */
    public function setSku($sku)
    {
        $this->sku = $sku;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getShortdesc()
    {
        return $this->shortdesc;
    }

    /**
     * @param mixed $shortdesc
     */
    public function setShortdesc($shortdesc)
    {
        $this->shortdesc = $shortdesc;
    }

    /**
     * @return mixed
     */
    public function getLongdesc()
    {
        return $this->longdesc;
    }

    /**
     * @param mixed $longdesc
     */
    public function setLongdesc($longdesc)
    {
        $this->longdesc = $longdesc;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * @param mixed $stock
     */
    public function setStock($stock)
    {
        $this->stock = $stock;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }






    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }


}