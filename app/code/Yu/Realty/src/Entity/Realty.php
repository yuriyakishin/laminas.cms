<?php

namespace Yu\Realty\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Realty
 *
 * @ORM\Table(name="realty", indexes={@ORM\Index(name="type", columns={"type"}), @ORM\Index(name="sort", columns={"sort"}), @ORM\Index(name="user_id", columns={"user_id"}), @ORM\Index(name="active", columns={"active"}), @ORM\Index(name="agent_id", columns={"agent_id"}), @ORM\Index(name="code", columns={"code"}), @ORM\Index(name="site_id", columns={"site_id"})})
 * @ORM\Entity(repositoryClass="\Yu\Realty\Repository\RealtyRepository")
 */
class Realty
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", precision=0, scale=0, nullable=false, options={"unsigned"=true}, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="site_id", type="integer", precision=0, scale=0, nullable=false, options={"unsigned"=true}, unique=false)
     */
    private $siteId;

    /**
     * @var int
     *
     * @ORM\Column(name="user_id", type="integer", precision=0, scale=0, nullable=false, options={"unsigned"=true}, unique=false)
     */
    private $userId;

    /**
     * @var bool
     *
     * @ORM\Column(name="active", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $active;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=20, precision=0, scale=0, nullable=false, unique=false)
     */
    private $type;

    /**
     * @var string|null
     *
     * @ORM\Column(name="code", type="string", length=20, precision=0, scale=0, nullable=true, unique=false)
     */
    private $code;

    /**
     * @var int|null
     *
     * @ORM\Column(name="agent_id", type="integer", precision=0, scale=0, nullable=true, options={"unsigned"=true}, unique=false)
     */
    private $agentId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="sort", type="integer", precision=0, scale=0, nullable=true, options={"unsigned"=true}, unique=false)
     */
    private $sort;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_at", type="datetime", precision=0, scale=0, nullable=true, unique=false)
     */
    private $createdAt;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="updated_at", type="datetime", precision=0, scale=0, nullable=true, unique=false)
     */
    private $updatedAt;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set siteId.
     *
     * @param int $siteId
     *
     * @return Realty
     */
    public function setSiteId($siteId)
    {
        $this->siteId = $siteId;

        return $this;
    }

    /**
     * Get siteId.
     *
     * @return int
     */
    public function getSiteId()
    {
        return $this->siteId;
    }

    /**
     * Set userId.
     *
     * @param int $userId
     *
     * @return Realty
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId.
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set active.
     *
     * @param bool $active
     *
     * @return Realty
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active.
     *
     * @return bool
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set type.
     *
     * @param string $type
     *
     * @return Realty
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set code.
     *
     * @param string|null $code
     *
     * @return Realty
     */
    public function setCode($code = null)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code.
     *
     * @return string|null
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set agentId.
     *
     * @param int|null $agentId
     *
     * @return Realty
     */
    public function setAgentId($agentId = null)
    {
        $this->agentId = $agentId;

        return $this;
    }

    /**
     * Get agentId.
     *
     * @return int|null
     */
    public function getAgentId()
    {
        return $this->agentId;
    }

    /**
     * Set sort.
     *
     * @param int|null $sort
     *
     * @return Realty
     */
    public function setSort($sort = null)
    {
        $this->sort = $sort;

        return $this;
    }

    /**
     * Get sort.
     *
     * @return int|null
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * Set createdAt.
     *
     * @param \DateTime|null $createdAt
     *
     * @return Realty
     */
    public function setCreatedAt($createdAt = null)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt.
     *
     * @return \DateTime|null
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt.
     *
     * @param \DateTime|null $updatedAt
     *
     * @return Realty
     */
    public function setUpdatedAt($updatedAt = null)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt.
     *
     * @return \DateTime|null
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}