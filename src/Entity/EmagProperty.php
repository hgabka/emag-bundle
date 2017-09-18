<?php

namespace Hgabka\EmagBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EmagProperty.
 *
 * @ORM\Entity(repositoryClass="Hgabka\EmagBundle\Repository\EmagPropertyRepository")
 * @ORM\Table(name="hg_emag_emag_property")
 */
class EmagProperty
{
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
     * @var bool
     *
     * @ORM\Column(type="boolean", name="is_required")
     */
    protected $isRequired = false;

    /**
     * @var EmagCategory
     *
     * @ORM\ManyToOne(targetEntity="Hgabka\EmagBundle\Entity\EmagCategory", inversedBy="properties", cascade={"persist"})
     * @ORM\JoinColumn(name="emag_category_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $category;

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
     * @return EmagProperty
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
     * @return EmagProperty
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
     * @return EmagProperty
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return bool
     */
    public function isRequired(): bool
    {
        return $this->isRequired;
    }

    /**
     * @param bool $isRequired
     *
     * @return EmagProperty
     */
    public function setIsRequired($isRequired)
    {
        $this->isRequired = $isRequired;

        return $this;
    }

    /**
     * @return EmagCategory
     */
    public function getCategory(): EmagCategory
    {
        return $this->category;
    }

    /**
     * @param EmagCategory $category
     *
     * @return EmagProperty
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }
}
