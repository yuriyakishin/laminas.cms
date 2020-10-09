<?php

namespace Yu\Realty\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Agent
 *
 * @ORM\Table(name="agent", indexes={@ORM\Index(name="site_id", columns={"site_id"})})
 * @ORM\Entity(repositoryClass="\Yu\Realty\Repository\AgentRepository")
 */
class Agent
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
     * @var string|null
     *
     * @ORM\Column(name="code", type="string", length=20, nullable=true)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=250, precision=0, scale=0, nullable=false, unique=false)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="phone1", type="string", length=250, precision=0, scale=0, nullable=true, unique=false)
     */
    private $phone1;

    /**
     * @var string|null
     *
     * @ORM\Column(name="phone2", type="string", length=250, precision=0, scale=0, nullable=true, unique=false)
     */
    private $phone2;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=250, precision=0, scale=0, nullable=true, unique=false)
     */
    private $email;

    /**
     * @var string|null
     *
     * @ORM\Column(name="post", type="string", length=250, precision=0, scale=0, nullable=true, unique=false)
     */
    private $post;

    /**
     * @var string|null
     *
     * @ORM\Column(name="adout", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $adout;


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
     * @return Agent
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
     * Set code.
     *
     * @param string|null $code
     *
     * @return Agent
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
     * Set name.
     *
     * @param string $name
     *
     * @return Agent
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set phone1.
     *
     * @param string|null $phone1
     *
     * @return Agent
     */
    public function setPhone1($phone1 = null)
    {
        $this->phone1 = $phone1;

        return $this;
    }

    /**
     * Get phone1.
     *
     * @return string|null
     */
    public function getPhone1()
    {
        return $this->phone1;
    }

    /**
     * Set phone2.
     *
     * @param string|null $phone2
     *
     * @return Agent
     */
    public function setPhone2($phone2 = null)
    {
        $this->phone2 = $phone2;

        return $this;
    }

    /**
     * Get phone2.
     *
     * @return string|null
     */
    public function getPhone2()
    {
        return $this->phone2;
    }

    /**
     * Set email.
     *
     * @param string|null $email
     *
     * @return Agent
     */
    public function setEmail($email = null)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email.
     *
     * @return string|null
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set post.
     *
     * @param string|null $post
     *
     * @return Agent
     */
    public function setPost($post = null)
    {
        $this->post = $post;

        return $this;
    }

    /**
     * Get post.
     *
     * @return string|null
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * Set adout.
     *
     * @param string|null $adout
     *
     * @return Agent
     */
    public function setAdout($adout = null)
    {
        $this->adout = $adout;

        return $this;
    }

    /**
     * Get adout.
     *
     * @return string|null
     */
    public function getAdout()
    {
        return $this->adout;
    }
}
