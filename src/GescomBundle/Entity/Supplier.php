<?php

namespace GescomBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Supplier
 *
 * @ORM\Table(name="supplier")
 * @ORM\Entity(repositoryClass="GescomBundle\Repository\SupplierRepository")
 */
class Supplier
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(name="address", type="string", length=255)
     * @Assert\NotEqualTo(value={{"$name"}})
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid one. maybe use @.",
     *     checkMX = true
     * )
     */
    private $email;

    /**
     * @var int
     *
     * @ORM\Column(name="postcode", type="integer")
     * @Assert\Regex(
     *     pattern  = "/^\d{4}?$/",
     *      match   = false,
     *     message  = "Your postcode must contains 5 numbers"
     * )
     */
    private $postcode;

    /**
     * @var string
     * @ORM\Column(name="town", type="string", length=255)
     * @Assert\Regex(
     *     pattern  = "/[A-Za-z \-']+/",
     *      message = "Your town must contains alphanumeric characters"
     * )
     */
    private $town;

    /**
     * @var string
     *
     * @ORM\Column(name="siret", type="string", length=255)
     * @Assert\Regex(
     *      pattern = "/[0-9]{3}[ \.\-]?[0-9]{3}[ \.\-]?[0-9]{3}[ \.\-]?[0-9]{5}/",
     *      message = "Tour Siret must contains 14 figures"
     * )
     */
    private $siret;

    /**
     * @var string
     *@ORM\Column(name="website", type="string", length=255)
     * @Assert\Url()
     */
    private $website;

    /**
     * @var int
     *
     * @ORM\Column(name="delivery_delay", type="integer")
     * @Assert\Regex(
     *     pattern      =   "/^[0-3]?[0-9]/",
     *      message     =   "Your delivery delay must be between 1 and 30 days"
     * )
     */
    private $deliveryDelay;

    /**
     * @var int
     *
     * @ORM\Column(name="score", type="integer")
     * @Assert\Regex("/^[1-5]/")
     */
    private $score;


    /**
     * @var
     * One Supplier has Many ProductSuppliers
     * @ORM\OneToMany(targetEntity="ProductSupplier", mappedBy="supplier")
     */
    private $productSuppliers;



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
     * Set name
     *
     * @param string $name
     *
     * @return Supplier
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Supplier
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Supplier
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set postcode
     *
     * @param integer $postcode
     *
     * @return Supplier
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;

        return $this;
    }

    /**
     * Get postcode
     *
     * @return int
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * Set town
     *
     * @param string $town
     *
     * @return Supplier
     */
    public function setTown($town)
    {
        $this->town = $town;

        return $this;
    }

    /**
     * Get town
     *
     * @return string
     */
    public function getTown()
    {
        return $this->town;
    }

    /**
     * Set siret
     *
     * @param string $siret
     *
     * @return Supplier
     */
    public function setSiret($siret)
    {
        $this->siret = $siret;

        return $this;
    }

    /**
     * Get siret
     *
     * @return string
     */
    public function getSiret()
    {
        return $this->siret;
    }

    /**
     * Set website
     *
     * @param string $website
     *
     * @return Supplier
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set deliveryDelay
     *
     * @param integer $deliveryDelay
     *
     * @return Supplier
     */
    public function setDeliveryDelay($deliveryDelay)
    {
        $this->deliveryDelay = $deliveryDelay;

        return $this;
    }

    /**
     * Get deliveryDelay
     *
     * @return int
     */
    public function getDeliveryDelay()
    {
        return $this->deliveryDelay;
    }

    /**
     * Set score
     *
     * @param integer $score
     *
     * @return Supplier
     */
    public function setScore($score)
    {
        $this->score = $score;

        return $this;
    }

    /**
     * Get score
     *
     * @return int
     */
    public function getScore()
    {
        return $this->score;
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->productSuppliers = new ArrayCollection();
    }

    /**
     * Add productSupplier
     *
     * @param ProductSupplier $productSupplier
     *
     * @return Supplier
     */
    public function addProductSupplier(ProductSupplier $productSupplier)
    {
        $this->productSuppliers[] = $productSupplier;

        return $this;
    }

    /**
     * Remove productSupplier
     *
     * @param ProductSupplier $productSupplier
     */
    public function removeProductSupplier(ProductSupplier $productSupplier)
    {
        $this->productSuppliers->removeElement($productSupplier);
    }

    /**
     * Get productSuppliers
     *
     * @return Collection
     */
    public function getProductSuppliers()
    {
        return $this->productSuppliers;
    }


}
