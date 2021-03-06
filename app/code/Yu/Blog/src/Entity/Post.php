<?php

namespace Yu\Blog\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="\Yu\Blog\Repository\PostRepository")
 * @ORM\Table(name="post", indexes={@ORM\Index(name="identifier_idx", columns={"identifier"}),
 *     @ORM\Index(name="active_idx", columns={"active"}), @ORM\Index(name="site_id_idx", columns={"site_id"}),
 *     @ORM\Index(name="rubric_idx", columns={"rubric_id"}), @ORM\Index(name="sort_idx", columns={"sort"})})
 */
class Post
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="active", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $active;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var int
     *
     * @ORM\Column(name="site_id", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $site_id;

    /**
     * @var int
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $user_id;

    /**
     * @var int
     *
     * @ORM\Column(name="rubric_id", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $rubric_id;

    /**
     * @var int
     *
     * @ORM\Column(name="sort", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $sort;

    /**
     * @var string
     *
     * @ORM\Column(name="identifier", type="string", unique=true, length=100, nullable=false)
     */
    private $identifier;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="text", nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="anons", type="text", nullable=true)
     */
    private $anons;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", nullable=true)
     */
    private $content;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $createdAt = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $updatedAt = 'CURRENT_TIMESTAMP';

    /**
     * @ORM\ManyToOne(targetEntity="\Yu\Blog\Entity\Rubric", inversedBy="posts")
     * @ORM\JoinColumn(name="rubric_id", referencedColumnName="id")
     */
    private $rubric;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getActive(): int
    {
        return $this->active;
    }

    /**
     * @param int $active
     */
    public function setActive($active): void
    {
        $this->active = $active;
    }

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate(\DateTime $date): void
    {
        $this->date = $date;
    }

    /**
     * @return int
     */
    public function getSiteId(): int
    {
        return $this->site_id;
    }

    /**
     * @param int $site_id
     */
    public function setSiteId($site_id): void
    {
        $this->site_id = $site_id;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     */
    public function setUserId($user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return int
     */
    public function getRubricId(): int
    {
        return $this->rubric_id;
    }

    /**
     * @param int $rubric_id
     */
    public function setRubricId($rubric_id): void
    {
        $this->rubric_id = $rubric_id;
    }

    /**
     * @return int
     */
    public function getSort(): int
    {
        return $this->sort;
    }

    /**
     * @param int $sort
     */
    public function setSort($sort): void
    {
        if(empty($sort)) {
            $sort = 100;
        }
        $this->sort = $sort;
    }

    /**
     * @return string
     */
    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    /**
     * @param string $identifier
     */
    public function setIdentifier($identifier): void
    {
        $this->identifier = $identifier;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getAnons()
    {
        return $this->anons;
    }

    /**
     * @param string $anons
     */
    public function setAnons($anons): void
    {
        $this->anons = $anons;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content): void
    {
        $this->content = $content;
    }

    
    /**
     * @return \DateTime|null
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime|null $createdAt
     */
    public function setCreatedAt($createdAt = null)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt($updatedAt = null)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return mixed
     */
    public function getRubric()
    {
        return $this->rubric;
    }

    /**
     * @param Rubric $rubric
     */
    public function setRubric(Rubric $rubric)
    {
        $this->rubric = $rubric;
        $this->rubric->addPost($this);
    }

}