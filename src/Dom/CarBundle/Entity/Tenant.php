<?php

namespace Dom\CarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Tenant
 *
 * @ORM\Table(name="tenant")
 * @ORM\Entity(repositoryClass="Dom\CarBundle\Repository\TenantRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Tenant
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
     * @ORM\Column(name="full_name", type="string", length=255)
     */
    private $fullName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

	/**
	 * @ORM\OneToMany(targetEntity="History", mappedBy="tenant")
	 */
	private $tenants;

	public function __construct()
	{
		$this->products = new ArrayCollection();
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
     * Set fullName
     *
     * @param string $fullName
     *
     * @return Tenant
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;

        return $this;
    }

    /**
     * Get fullName
     *
     * @return string
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Tenant
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Tenant
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

	/**
	 *
	 * @ORM\PrePersist
	 * @ORM\PreUpdate
	 */
	public function updatedTimestamps()
	{
		$this->setUpdatedAt(new \DateTime(date('Y-m-d H:i:s')));

		if($this->getCreatedAt() == null)
		{
			$this->setCreatedAt(new \DateTime(date('Y-m-d H:i:s')));
		}
	}

    /**
     * Add tenant
     *
     * @param \Dom\CarBundle\Entity\History $tenant
     *
     * @return Tenant
     */
    public function addTenant(\Dom\CarBundle\Entity\History $tenant)
    {
        $this->tenants[] = $tenant;

        return $this;
    }

    /**
     * Remove tenant
     *
     * @param \Dom\CarBundle\Entity\History $tenant
     */
    public function removeTenant(\Dom\CarBundle\Entity\History $tenant)
    {
        $this->tenants->removeElement($tenant);
    }

    /**
     * Get tenants
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTenants()
    {
        return $this->tenants;
    }
}
