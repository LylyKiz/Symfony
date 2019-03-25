<?php

namespace Dom\CarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * History
 *
 * @ORM\Table(name="history")
 * @ORM\Entity(repositoryClass="Dom\CarBundle\Repository\HistoryRepository")
 */
class History
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
     * @ORM\Column(name="data_taking", type="datetime")
     */
    private $dataTaking;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_return", type="datetime")
     */
    private $dataReturn;


	/**
	 * @ORM\ManyToOne(targetEntity="Car", inversedBy="cars")
	 * @ORM\JoinColumn(name="car_id", referencedColumnName="id")
	 */
	private $car;

	/**
	 * @ORM\ManyToOne(targetEntity="Tenant", inversedBy="tenants")
	 * @ORM\JoinColumn(name="tenant_id", referencedColumnName="id")
	 */
	private $tenant;

	/**
	 * @ORM\ManyToOne(targetEntity="Point", inversedBy="pointers")
	 * @ORM\JoinColumn(name="point_id", referencedColumnName="id")
	 */
	private $point;

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
     * Set dataTaking
     *
     * @param \DateTime $dataTaking
     *
     * @return History
     */
    public function setDataTaking($dataTaking)
    {
        $this->dataTaking = $dataTaking;

        return $this;
    }

    /**
     * Get dataTaking
     *
     * @return \DateTime
     */
    public function getDataTaking()
    {
        return $this->dataTaking;
    }

    /**
     * Set dataReturn
     *
     * @param \DateTime $dataReturn
     *
     * @return History
     */
    public function setDataReturn($dataReturn)
    {
        $this->dataReturn = $dataReturn;

        return $this;
    }

    /**
     * Get dataReturn
     *
     * @return \DateTime
     */
    public function getDataReturn()
    {
        return $this->dataReturn;
    }

    /**
     * Set car
     *
     * @param \Dom\CarBundle\Entity\Car $car
     *
     * @return History
     */
    public function setCar(\Dom\CarBundle\Entity\Car $car = null)
    {
        $this->car = $car;

        return $this;
    }

    /**
     * Get car
     *
     * @return \Dom\CarBundle\Entity\Car
     */
    public function getCar()
    {
        return $this->car;
    }

    /**
     * Set tenant
     *
     * @param \Dom\CarBundle\Entity\Tenant $tenant
     *
     * @return History
     */
    public function setTenant(\Dom\CarBundle\Entity\Tenant $tenant = null)
    {
        $this->tenant = $tenant;

        return $this;
    }

    /**
     * Get tenant
     *
     * @return \Dom\CarBundle\Entity\Tenant
     */
    public function getTenant()
    {
        return $this->tenant;
    }

	/**
	 * Set point
	 *
	 * @param \Dom\CarBundle\Entity\Point $point
	 *
	 * @return History
	 */
	public function setPoint(\Dom\CarBundle\Entity\Point $point = null)
	{
		$this->point = $point;

		return $this;
	}

	/**
	 * Get point
	 *
	 * @return \Dom\CarBundle\Entity\Point
	 */
	public function getPoint()
	{
		return $this->point;
	}
}
