<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 16/02/2019
 * Time: 09:12
 */

namespace ProductBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;



/**
 * Class Categories
 * @ORM\Entity(repositoryClass="ProductBundle\Entity\CategoriesRepository")
 */


class Categories
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

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
     * @ORM\Column(type="string",length=255)
     */
    private $CategoryName;
    /**
     * @ORM\Column(type="string",length=255)
     */
    private  $CategoryDesc;
    /**
     * @var  string
     * @Assert\NotBlank(message="please insert your image")
     * @Assert\Image()
     * @Orm\Column(type="string",length=255)
     */
    private  $CategoryImage;

    /**
     * @return mixed
     */



    /**
     * @return mixed
     */
    public function getCategoryName()
    {
        return $this->CategoryName;
    }

    /**
     * @param mixed $CategoryName
     */
    public function setCategoryName($CategoryName)
    {
        $this->CategoryName = $CategoryName;
    }

    /**
     * @return mixed
     */
    public function getCategoryDesc()
    {
        return $this->CategoryDesc;
    }

    /**
     * @param mixed $CategoryDesc
     */
    public function setCategoryDesc($CategoryDesc)
    {
        $this->CategoryDesc = $CategoryDesc;
    }

    /**
     * @return mixed
     */
    public function getCategoryImage()
    {
        return $this->CategoryImage;
    }

    /**
     * @param mixed $CategoryImage
     */
    public function setCategoryImage($CategoryImage)
    {
        $this->CategoryImage = $CategoryImage;
    }






}