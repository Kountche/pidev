<?php
namespace SavBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Claims")
 */

class Claims
{
    /**
     * @ORM\GeneratedValue
     * @ORM\Id
     * @ORM\column(type="integer")
     */
    private $Claims_id;

    /**
     * @ORM\column(type="string" ,length=255)
     */
    private $claim_username;

    /**
     * @ORM\column(type="string" ,length=255)
     */
    private $claim_lastname;

    /**
     * @ORM\column(type="string" ,length=255)
     */
    private $claim_email;

    /**
     * @ORM\column(type="string" ,length=255)
     */
    private $Claim_Productref;

    /**
     * @ORM\column(type="integer")
     */
    private $claim_codepostal;

    /**
     * @ORM\column(type="string" ,length=255)
     */
    private $claim_country;


    /**
     * @ORM\column(type="integer")
     */
    private $phone;


    /**
     * @ORM\column(type="integer")
     */
    private $Claim_Iduser;


    /**
     * @ORM\column(type="integer")
     */
    private $Claim_Productid;


    /**
     * @ORM\column(type="string" ,length=255)
     */
    private $Claim_Desc;


    /**
     * @ORM\column(type="integer")
     */
    private $Claim_Etat;

    /**
     * @ORM\column(type="datetime")
     */
    private $Claim_Date;

    /**
     * @return mixed
     */
    public function getClaimsId()
    {
        return $this->Claims_id;
    }

    /**
     * @param mixed $Claims_id
     */
    public function setClaimsId($Claims_id)
    {
        $this->Claims_id = $Claims_id;
    }

    /**
     * @return mixed
     */
    public function getClaimUsername()
    {
        return $this->claim_username;
    }

    /**
     * @param mixed $claim_username
     */
    public function setClaimUsername($claim_username)
    {
        $this->claim_username = $claim_username;
    }

    /**
     * @return mixed
     */
    public function getClaimLastname()
    {
        return $this->claim_lastname;
    }

    /**
     * @param mixed $claim_lastname
     */
    public function setClaimLastname($claim_lastname)
    {
        $this->claim_lastname = $claim_lastname;
    }

    /**
     * @return mixed
     */
    public function getClaimEmail()
    {
        return $this->claim_email;
    }

    /**
     * @param mixed $claim_email
     */
    public function setClaimEmail($claim_email)
    {
        $this->claim_email = $claim_email;
    }

    /**
     * @return mixed
     */
    public function getClaimProductref()
    {
        return $this->Claim_Productref;
    }

    /**
     * @param mixed $Claim_Productref
     */
    public function setClaimProductref($Claim_Productref)
    {
        $this->Claim_Productref = $Claim_Productref;
    }

    /**
     * @return mixed
     */
    public function getClaimCodepostal()
    {
        return $this->claim_codepostal;
    }

    /**
     * @param mixed $claim_codepostal
     */
    public function setClaimCodepostal($claim_codepostal)
    {
        $this->claim_codepostal = $claim_codepostal;
    }

    /**
     * @return mixed
     */
    public function getClaimCountry()
    {
        return $this->claim_country;
    }

    /**
     * @param mixed $claim_country
     */
    public function setClaimCountry($claim_country)
    {
        $this->claim_country = $claim_country;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getClaimIduser()
    {
        return $this->Claim_Iduser;
    }

    /**
     * @param mixed $Claim_Iduser
     */
    public function setClaimIduser($Claim_Iduser)
    {
        $this->Claim_Iduser = $Claim_Iduser;
    }

    /**
     * @return mixed
     */
    public function getClaimProductid()
    {
        return $this->Claim_Productid;
    }

    /**
     * @param mixed $Claim_Productid
     */
    public function setClaimProductid($Claim_Productid)
    {
        $this->Claim_Productid = $Claim_Productid;
    }

    /**
     * @return mixed
     */
    public function getClaimDesc()
    {
        return $this->Claim_Desc;
    }

    /**
     * @param mixed $Claim_Desc
     */
    public function setClaimDesc($Claim_Desc)
    {
        $this->Claim_Desc = $Claim_Desc;
    }

    /**
     * @return mixed
     */
    public function getClaimEtat()
    {
        return $this->Claim_Etat;
    }

    /**
     * @param mixed $Claim_Etat
     */
    public function setClaimEtat($Claim_Etat)
    {
        $this->Claim_Etat = $Claim_Etat;
    }

    /**
     * @return mixed
     */
    public function getClaimDate()
    {
        return $this->Claim_Date;
    }

    /**
     * @param mixed $Claim_Date
     */
    public function setClaimDate($Claim_Date)
    {
        $this->Claim_Date = $Claim_Date;
    }




}


