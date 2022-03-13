<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2/28/2019
 * Time: 10:43
 */

namespace OrderBundle\Entity;
use Doctrine\ORM\Mapping as Orm;

/**
 * Class comment
 * @ORM\Entity
 */
class CommentEvent
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\ManyToOne(targetEntity="EventBundle\Entity\Evennement")
     * @ORM\JoinColumn(referencedColumnName="idEvent")
     */
    private $idev;
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private $clientid;

    /**
     * @Orm\Column(type="string",length=255,nullable=true)
     */
    private $comment;

    /**
     * CommentEvent constructor.
     */
    public function __construct()
    {
    }

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
    public function getIdev()
    {
        return $this->idev;
    }

    /**
     * @param mixed $idev
     */
    public function setIdev($idev)
    {
        $this->idev = $idev;
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
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param mixed $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }




}