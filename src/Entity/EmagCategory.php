<?php

namespace Hgabka\EmagBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * EmagCategory.
 *
 * @ORM\Entity(repositoryClass="Hgabka\EmagBundle\Repository\EmagPCategoryRepository")
 * @ORM\Table(name="hg_emag_emag_category")
 */
class EmagCategory
{
    /**
     * @var ArrayCollection|EmaagProperty[]
     *
     * @ORM\OneToMany(targetEntity="Hgabka\EmagBundle\Entity\EmagProperty", cascade={"all"}, mappedBy="category", orphanRemoval=true)
     *
     * @Assert\Valid()
     */
    protected $properties;

    /**
     * @ORM\Id
     * @ORM\Column(type="bigint")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", name="emag_id")
     */
    protected $emagId;

    /**
     * @var string
     *
     * @ORM\Column(type="string", name="name", nullable=true)
     */
    protected $name;

    /**
     * EmagCategory constructor.
     */
    public function __construct()
    {
        $this->properties = new ArrayCollection();
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
     *
     * @return EmagCategory
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int
     */
    public function getEmagId(): int
    {
        return $this->emagId;
    }

    /**
     * @param int $emagId
     *
     * @return EmagCategory
     */
    public function setEmagId($emagId)
    {
        $this->emagId = $emagId;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return EmagCategory
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return EmagProperty[]
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * @param EmagProperty[] $properties
     * @param mixed          $templates
     *
     * @return EmagCategory
     */
    public function setTemplates($templates)
    {
        $this->templates = $templates;

        return $this;
    }

    /**
     * Add property.
     *
     * @param EmagProperty $property
     *
     * @return EmagCategory
     */
    public function addProperty(EmagProperty $property)
    {
        if (!$this->properties->contains($property)) {
            $this->properties[] = $property;

            $property->setCategory($this);
        }

        return $this;
    }

    /**
     * Remove property.
     *
     * @param EmagProperty $property
     */
    public function removeProperty(EmagProperty $property)
    {
        $this->properties->removeElement($property);
    }
}
