<?php

namespace chasseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * annimal
 *
 * @ORM\Table(name="annimal")
 * @ORM\Entity(repositoryClass="chasseBundle\Repository\annimalRepository")
 */
class annimal
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
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_annimal", type="string", length=255 )
     */
    public $nomAnnimal;
    /**
     * @var string
     * @ORM\Column(name="image", type="string", length=255 )
     */
    public $image;


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
     * Set description
     *
     * @param string $description
     *
     * @return annimal
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set nomAnnimal
     *
     * @param string $nomAnnimal
     *
     * @return annimal
     */
    public function setNomAnnimal($nomAnnimal)
    {
        $this->nomAnnimal = $nomAnnimal;

        return $this;
    }

    /**
     * Get nomAnnimal
     *
     * @return string
     */
    public function getNomAnnimal()
    {
        return $this->nomAnnimal;
    }


    /**
     * Set image
     *
     * @param string $image
     *
     * @return annimal
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }
}
