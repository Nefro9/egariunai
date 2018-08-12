<?php


namespace App\AdminBundle\Entity111;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;

/**
 * Category
 *
 * @ORM\Table(name="product_category")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\ProductCategoryRepository")
 * @ORM\HasLifecycleCallbacks
 */
class ProductCategory
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    /**
     * One ProductCategory has Many ProductCategories.
     * @ORM\OneToMany(targetEntity="ProductCategory", mappedBy="parent")
     */
    private $children;

    /**
     * Many ProductCategories have One ProductCategory.
     * @ORM\ManyToOne(targetEntity="ProductCategory", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", nullable=true)
     */
    public $parent;

    /**
     * @var int
     *
     * @ORM\Column(name="order_nr", type="integer", nullable=true)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $order;

    /**
     * ProductCategory constructor.
     */
    public function __construct()
    {
        $this->children = new ArrayCollection();
    }

    /**
     * @param ProductCategory $children
     * @return $this
     */
    public function addChildren (ProductCategory $children)
    {
        $this->children[] = $children;

        return $this;
    }

    /**
     * @return arrayCollection
     */
    public function getChildren ()
    {
        return $this->children;
    }

    /**
     * @param ProductCategory $parent
     * @return $this
     */
    public function addParent (ProductCategory $parent)
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * @return ProductCategory
     */
    public function getParent ()
    {
        return $this->parent;
    }

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
     * Set title
     *
     * @param string $title
     *
     * @return ProductCategory
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return ProductCategory
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set order
     *
     * @param integer $order
     *
     * @return ProductCategory
     */
    public function setOrder($order)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get orderNr
     *
     * @return int
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function onUpdate()
    {
        $slugify    = new Slugify();
        $this->slug = $slugify->slugify( $this->title );

    }
}

