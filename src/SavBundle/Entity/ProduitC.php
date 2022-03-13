<?php
namespace SavBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="ProduitC")
 */

class ProduitC
{

    /**
     * @ORM\GeneratedValue
     * @ORM\Id
     * @ORM\column(type="integer")
     */
    private $produitid;

    /**
     *  @ORM\column(type="string" ,length=255)
     */
    private $produitref;

    /**
     * @ORM\column(type="string" ,length=255)
     */
    private $produitname;

    /**
     * @return mixed
     */
    public function getProduitid()
    {
        return $this->produitid;
    }

    /**
     * @param mixed $produitid
     */
    public function setProduitid($produitid)
    {
        $this->produitid = $produitid;
    }

    /**
     * @return mixed
     */
    public function getProduitref()
    {
        return $this->produitref;
    }

    /**
     * @param mixed $produitref
     */
    public function setProduitref($produitref)
    {
        $this->produitref = $produitref;
    }

    /**
     * @return mixed
     */
    public function getProduitname()
    {
        return $this->produitname;
    }

    /**
     * @param mixed $produitname
     */
    public function setProduitname($produitname)
    {
        $this->produitname = $produitname;
    }


}
