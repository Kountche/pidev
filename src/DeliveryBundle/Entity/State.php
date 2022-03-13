<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 16/02/2019
 * Time: 21:47
 */

namespace DeliveryBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * State
 *
 * @ORM\Table(name="State")
 * @ORM\Entity
 */


class State
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idstate", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idstate;

    /**
     * @var string
     *
     * @ORM\Column(name="delivring", type="string", length=30, nullable=true)
     */
    private $delivring;

    /**
     * @var string
     *
     * @ORM\Column(name="delivred", type="string", length=150, nullable=true)
     */
    private $delivred;
    /**
     * @var string
     *
     * @ORM\Column(name="pending", type="string", length=150, nullable=true)
     */
    private $pending;
    /**
     * @var string
     *
     * @ORM\Column(name="problem", type="string", length=150, nullable=true)
     */
    private $problem;
    /**
     * @return int
     */
    public function getidstate()
    {
        return $this->idstate;
    }

    /**
     * @param int $idstate
     */
    public function setidstate($idstate)
    {
        $this->idstate = $idstate;
    }
    /**
     * @return string
     */
    public function getdelivring()
    {
        return $this->delivring;
    }

    /**
     * @param string $delivring
     */
    public function setdelivring($delivring)
    {
        $this->delivring = $delivring;
    }
    /**
     * @return string
     */
    public function getdelivred()
    {
        return $this->delivred;
    }

    /**
     * @param string $delivred
     */
    public function setdelivred($delivred)
    {
        $this->delivred = $delivred;
    }
    /**
     * @return string
     */
    public function getpending()
    {
        return $this->pending;
    }

    /**
     * @param string $pending
     */
    public function setpending($pending)
    {
        $this->pending = $pending;
    }
    /**
     * @return string
     */
    public function getproblem()
    {
        return $this->problem;
    }

    /**
     * @param string $problem
     */
    public function setproblem($problem)
    {
        $this->problem = $problem;
    }

}