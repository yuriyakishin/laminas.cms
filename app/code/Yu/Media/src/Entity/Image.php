<?php

namespace Yu\Media\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Image
 *
 * @ORM\Entity(repositoryClass="\Yu\Media\Repository\ImageRepository")
 * @ORM\Table(name="image", indexes={@ORM\Index(name="images_path_id_path_index", columns={"path_id", "path"}), @ORM\Index(name="images_temp_index", columns={"temp"}), @ORM\Index(name="images_active_index", columns={"active"}), @ORM\Index(name="images_sort_index", columns={"sort"}), @ORM\Index(name="images_type_index", columns={"type"})})
 */
class Image
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
     * @var int
     *
     * @ORM\Column(name="path_id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $pathId;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=100, precision=0, scale=0, nullable=false, unique=false)
     */
    private $path;

    /**
     * @var bool
     *
     * @ORM\Column(name="temp", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $temp;

    /**
     * @var int
     *
     * @ORM\Column(name="sort", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $sort;

    /**
     * @var bool
     *
     * @ORM\Column(name="active", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $active;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=200, precision=0, scale=0, nullable=false, unique=false)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="image_name", type="string", length=200, precision=0, scale=0, nullable=false, unique=false)
     */
    private $imageName;

    /**
     * @var string
     *
     * @ORM\Column(name="image_dir", type="string", length=200, precision=0, scale=0, nullable=false, unique=false)
     */
    private $imageDir;

    /**
     * @var string
     *
     * @ORM\Column(name="image_size", type="string", length=10, precision=0, scale=0, nullable=false, unique=false)
     */
    private $imageSize;

    /**
     * @var string
     *
     * @ORM\Column(name="image_width", type="string", length=10, precision=0, scale=0, nullable=false, unique=false)
     */
    private $imageWidth;

    /**
     * @var string
     *
     * @ORM\Column(name="image_height", type="string", length=10, precision=0, scale=0, nullable=false, unique=false)
     */
    private $imageHeight;

    /**
     * @var string|null
     *
     * @ORM\Column(name="comment", type="string", length=191, precision=0, scale=0, nullable=true, unique=false)
     */
    private $comment;

    /**
     * @var string|null
     *
     * @ORM\Column(name="type", type="string", length=100, precision=0, scale=0, nullable=true, unique=false)
     */
    private $type;

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
     * @return Image
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
     * @return Image
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
     * Set pathId.
     *
     * @param int $pathId
     *
     * @return Image
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
     * @return Image
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
     * Set temp.
     *
     * @param bool $temp
     *
     * @return Image
     */
    public function setTemp($temp)
    {
        $this->temp = $temp;

        return $this;
    }

    /**
     * Get temp.
     *
     * @return bool
     */
    public function getTemp()
    {
        return $this->temp;
    }

    /**
     * Set sort.
     *
     * @param int $sort
     *
     * @return Image
     */
    public function setSort($sort)
    {
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
     * Set active.
     *
     * @param bool $active
     *
     * @return Image
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
     * Set image.
     *
     * @param string $image
     *
     * @return Image
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image.
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set imageName.
     *
     * @param string $imageName
     *
     * @return Image
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;

        return $this;
    }

    /**
     * Get imageName.
     *
     * @return string
     */
    public function getImageName()
    {
        return $this->imageName;
    }

    /**
     * Set imageDir.
     *
     * @param string $imageDir
     *
     * @return Image
     */
    public function setImageDir($imageDir)
    {
        $this->imageDir = $imageDir;

        return $this;
    }

    /**
     * Get imageDir.
     *
     * @return string
     */
    public function getImageDir()
    {
        return $this->imageDir;
    }

    /**
     * Set imageSize.
     *
     * @param string $imageSize
     *
     * @return Image
     */
    public function setImageSize($imageSize)
    {
        $this->imageSize = $imageSize;

        return $this;
    }

    /**
     * Get imageSize.
     *
     * @return string
     */
    public function getImageSize()
    {
        return $this->imageSize;
    }

    /**
     * Set imageWidth.
     *
     * @param string $imageWidth
     *
     * @return Image
     */
    public function setImageWidth($imageWidth)
    {
        $this->imageWidth = $imageWidth;

        return $this;
    }

    /**
     * Get imageWidth.
     *
     * @return string
     */
    public function getImageWidth()
    {
        return $this->imageWidth;
    }

    /**
     * Set imageHeight.
     *
     * @param string $imageHeight
     *
     * @return Image
     */
    public function setImageHeight($imageHeight)
    {
        $this->imageHeight = $imageHeight;

        return $this;
    }

    /**
     * Get imageHeight.
     *
     * @return string
     */
    public function getImageHeight()
    {
        return $this->imageHeight;
    }

    /**
     * Set comment.
     *
     * @param string|null $comment
     *
     * @return Image
     */
    public function setComment($comment = null)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment.
     *
     * @return string|null
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set type.
     *
     * @param string|null $type
     *
     * @return Image
     */
    public function setType($type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type.
     *
     * @return string|null
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set createdAt.
     *
     * @param \DateTime|null $createdAt
     *
     * @return Image
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
     * @return Image
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