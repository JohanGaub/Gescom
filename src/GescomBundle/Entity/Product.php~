<?php

namespace GescomBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="GescomBundle\Repository\ProductRepository")
 */
class Product
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
     * @Assert\NotBlank(message = "Fulfill with a category name")
     * @Assert\Length(
     *     min = 3,
     *     minMessage = "The name category must be at least {{ 3 }} characters long"
     * )
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     * @Assert\NotBlank(message = "Fulfill with a category description")
     * @Assert\Length(
     *     min = 10,
     *     minMessage = "The name category must be at least {{ 10 }} characters long"
     * )
     */
    private $description;

    /**
     * @var Category
     * Each Product is owned by One Category
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="products", cascade={"persist"})
     *
     */
    private $category;

    /**
     * @var
     * One Product has Many ProductSuppliers
     * @ORM\OneToMany(targetEntity="ProductSupplier", mappedBy="product")
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
     * @return Product
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
     * Set description
     *
     * @param string $description
     *
     * @return Product
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
     * Set category
     *
     * @param Category $category
     *
     * @return Product
     */
    public function setCategory($category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
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
     * @return Product
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
     * @return ArrayCollection
     * @return Collection
     */
    public function getProductSuppliers()
    {
        return $this->productSuppliers;
    }

    // AJOUTE MAIS JE NE SAIS PAS POURQUOI
    public function resetProductSuppliers()
    {
        $this->productSuppliers = new ArrayCollection();
    }
}
