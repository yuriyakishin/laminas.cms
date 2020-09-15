<?php

namespace Yu\Poll\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PollOption
 *
 * @ORM\Table(name="poll_option", indexes={@ORM\Index(name="sort", columns={"sort"}), @ORM\Index(name="theme_id", columns={"theme_id"})})
 * @ORM\Entity(repositoryClass="\Yu\Poll\Repository\PollOptionRepository")
 */
class PollOption
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
     * @ORM\Column(name="theme_id", type="integer", precision=0, scale=0, nullable=false, options={"unsigned"=true}, unique=false)
     */
    private $themeId;

    /**
     * @var int
     *
     * @ORM\Column(name="sort", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $sort;

    /**
     * @var int
     *
     * @ORM\Column(name="result", type="integer", precision=0, scale=0, nullable=false, options={"unsigned"=true}, unique=false)
     */
    private $result;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="text", length=65535, precision=0, scale=0, nullable=false, unique=false)
     */
    private $value;


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
     * Set themeId.
     *
     * @param int $themeId
     *
     * @return PollOption
     */
    public function setThemeId($themeId)
    {
        $this->themeId = $themeId;

        return $this;
    }

    /**
     * Get themeId.
     *
     * @return int
     */
    public function getThemeId()
    {
        return $this->themeId;
    }

    /**
     * Set sort.
     *
     * @param int $sort
     *
     * @return PollOption
     */
    public function setSort(int $sort)
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
     * Set result.
     *
     * @param int $result
     *
     * @return PollOption
     */
    public function setResult($result)
    {
        $this->result = $result;

        return $this;
    }

    /**
     * Get result.
     *
     * @return int
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * Set value.
     *
     * @param string $value
     *
     * @return PollOption
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value.
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }
}
