<?php

namespace SarahBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Utilisateur
 *
 * @ORM\Table(name="utilisateur")
 * @ORM\Entity(repositoryClass="SarahBundle\Repository\UtilisateurRepository")
 */
class Utilisateur
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_br", type="date")
     */
    private $dateBr;

    /**
     * @var int
     *
     * @ORM\Column(name="lot", type="integer")
     */
    private $lot;

    /**
     * @var string
     *
     * @ORM\Column(name="reference", type="string", length=255)
     */
    private $reference;

    /**
     * @var int
     *
     * @ORM\Column(name="de", type="integer")
     */
    private $de;

    /**
     * @var int
     * @Assert\NotBlank(message="Impossible que le numéro de compteur est vide !!!")
     * @ORM\Column(name="compteur", type="integer", unique=true)
     */
    private $compteur;

    /**
     * @var string
     *
     * @ORM\Column(name="secteur", type="string", length=255)
     */
    private $secteur;

    /**
     * @var string
     *
     * @ORM\Column(name="planche", type="string", length=255)
     */
    private $planche;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set dateBr
     *
     * @param \DateTime $dateBr
     * @return Utilisateur
     */
    public function setDateBr($dateBr)
    {
        $this->dateBr = $dateBr;

        return $this;
    }

    /**
     * Get dateBr
     *
     * @return \DateTime 
     */
    public function getDateBr()
    {
        return $this->dateBr;
    }

    /**
     * Set lot
     *
     * @param integer $lot
     * @return Utilisateur
     */
    public function setLot($lot)
    {
        $this->lot = $lot;

        return $this;
    }

    /**
     * Get lot
     *
     * @return integer 
     */
    public function getLot()
    {
        return $this->lot;
    }

    /**
     * Set reference
     *
     * @param string $reference
     * @return Utilisateur
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get reference
     *
     * @return string 
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set de
     *
     * @param integer $de
     * @return Utilisateur
     */
    public function setDe($de)
    {
        $this->de = $de;

        return $this;
    }

    /**
     * Get de
     *
     * @return integer 
     */
    public function getDe()
    {
        return $this->de;
    }

    /**
     * Set compteur
     *
     * @param integer $compteur
     * @return Utilisateur
     */
    public function setCompteur($compteur)
    {
        $this->compteur = $compteur;

        return $this;
    }

    /**
     * Get compteur
     *
     * @return integer 
     */
    public function getCompteur()
    {
        return $this->compteur;
    }

    /**
     * Set secteur
     *
     * @param string $secteur
     * @return Utilisateur
     */
    public function setSecteur($secteur)
    {
        $this->secteur = $secteur;

        return $this;
    }

    /**
     * Get secteur
     *
     * @return string 
     */
    public function getSecteur()
    {
        return $this->secteur;
    }

    /**
     * Set planche
     *
     * @param string $planche
     * @return Utilisateur
     */
    public function setPlanche($planche)
    {
        $this->planche = $planche;

        return $this;
    }

    /**
     * Get planche
     *
     * @return string 
     */
    public function getPlanche()
    {
        return $this->planche;
    }
}
