<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 16/02/2019
 * Time: 11:27
 */

namespace MarketingBundle\Entity;
use Doctrine\ORM\Mapping as Orm;
use Doctrine\DBAL\Types\Type;



/**
 * Class Promotion
 * @ORM\Entity(repositoryClass="MarketingBundle\Entity\PromotionRepository")
 */
class Promotion
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="integer")
     */
    private $discount;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    private $dateD;
    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    private $dateF;

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
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * @param mixed $discount
     */
    public function setDiscount($discount)
    {
        $this->discount = $discount;
    }

    /**
     * @return mixed
     */
    public function getDateD()
    {
        return $this->dateD;
    }

    /**
     * @param mixed $dateD
     */
    public function setDateD($dateD)
    {
        $this->dateD = $dateD;
    }

    /**
     * @return mixed
     */
    public function getDateF()
    {
        return $this->dateF;
    }

    /**
     * @param mixed $dateF
     */
    public function setDateF($dateF)
    {
        $this->dateF = $dateF;
    }





}
