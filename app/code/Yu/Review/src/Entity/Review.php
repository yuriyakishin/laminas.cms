<?php

namespace Yu\Review\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Review
 *
 * @ORM\Table(name="review", indexes={@ORM\Index(name="active", columns={"active"}), @ORM\Index(name="sort", columns={"sort"})})
 * @ORM\Entity(repositoryClass="\Yu\Review\Repository\ReviewRepository")
 */
class Review
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
     * @ORM\Column(name="active", type="smallint", precision=0, scale=0, nullable=false, options={"unsigned"=true}, unique=false)
     */
    private $active;

    /**
     * @var int
     *
     * @ORM\Column(name="site_id", type="integer", precision=0, scale=0, nullable=false, options={"unsigned"=true}, unique=false)
     */
    private $siteId;

    /**
     * @var int
     *
     * @ORM\Column(name="path_id", type="integer", precision=0, scale=0, nullable=false, options={"unsigned"=true}, unique=false)
     */
    private $pathId;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=20, precision=0, scale=0, nullable=false, unique=false)
     */
    private $path;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", precision=0, scale=0, nullable=false, unique=false)
     */
    private $date;

    /**
     * @var int
     *
     * @ORM\Column(name="sort", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $sort;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=250, precision=0, scale=0, nullable=true, unique=false)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="content", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $content;


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
     * Set active.
     *
     * @param int $active
     *
     * @return Review
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active.
     *
     * @return int
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set siteId.
     *
     * @param int $siteId
     *
     * @return Review
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
     * Set pathId.
     *
     * @param int $pathId
     *
     * @return Review
     */
    public function setPathId($pathId)
    {
        $this->pathId = $pathId;

        return $this;
    }

    /**
     * Get pathId.
     *
     * @return int
     */
    public function getPathId()
    {
        return $this->pathId;
    }

    /**
     * Set path.
     *
     * @param string $path
     *
     * @return Review
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set date.
     *
     * @param \DateTime $date
     *
     * @return Review
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date.
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set sort.
     *
     * @param int $sort
     *
     * @return Review
     */
    public function setSort($sort)
    {
        if(empty($sort)) {
            $sort = 100;
        }
        $this->sort = $sort;

        return $this;
    }

    /**
     * Get sort.
     *
     * @return int
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * Set name.
     *
     * @param string|null $name
     *
     * @return Review
     */
    public function setName($name = null)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set content.
     *
     * @param string|null $content
     *
     * @return Review
     */
    public function setContent($content = null)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content.
     *
     * @return string|null
     */
    public function getContent()
    {
        return $this->content;
    }
}
