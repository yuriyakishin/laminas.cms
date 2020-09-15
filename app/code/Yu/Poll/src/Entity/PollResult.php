<?php

namespace Yu\Poll\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PollResult
 *
 * @ORM\Table(name="poll_result", indexes={@ORM\Index(name="option_id", columns={"option_id"}), @ORM\Index(name="theme_id", columns={"theme_id"}), @ORM\Index(name="ip", columns={"ip"})})
 * @ORM\Entity(repositoryClass="\Yu\Poll\Repository\PollResultRepository")
 */
class PollResult
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
     * @ORM\Column(name="option_id", type="integer", precision=0, scale=0, nullable=false, options={"unsigned"=true}, unique=false)
     */
    private $optionId;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=15, precision=0, scale=0, nullable=false, unique=false)
     */
    private $ip;


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
     * @return PollResult
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
     * Set optionId.
     *
     * @param int $optionId
     *
     * @return PollResult
     */
    public function setOptionId($optionId)
    {
        $this->optionId = $optionId;

        return $this;
    }

    /**
     * Get optionId.
     *
     * @return int
     */
    public function getOptionId()
    {
        return $this->optionId;
    }

    /**
     * Set ip.
     *
     * @param string $ip
     *
     * @return PollResult
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip.
     *
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }
}
