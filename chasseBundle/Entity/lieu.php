<?php

namespace chasseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * lieu
 *
 * @ORM\Table(name="lieu")
 * @ORM\Entity(repositoryClass="chasseBundle\Repository\lieuRepository")
 */
class lieu
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
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="description_lieu", type="string", length=255)
     */
    private $descriptionLieu;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return lieu
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set descriptionLieu
     *
     * @param string $descriptionLieu
     *
     * @return lieu
     */
    public function setDescriptionLieu($descriptionLieu)
    {
        $this->descriptionLieu = $descriptionLieu;

        return $this;
    }

    /**
     * Get descriptionLieu
     *
     * @return string
     */
    public function getDescriptionLieu()
    {
        return $this->descriptionLieu;
    }
}

