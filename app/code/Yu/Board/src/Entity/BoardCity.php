<?php

namespace Yu\Board\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BoardCity
 *
 * @ORM\Table(name="board_city", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})})
 * @ORM\Entity(repositoryClass="\Yu\Board\Repository\BoardCityRepository")
 */
class BoardCity
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
     * @var int|null
     *
     * @ORM\Column(name="num", type="integer", precision=0, scale=0, nullable=true, options={"unsigned"=true}, unique=false)
     */
    private $num;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50, precision=0, scale=0, nullable=false, unique=false)
     */
    private $name;


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
     * Set num.
     *
     * @param int|null $num
     *
     * @return BoardCity
     */
    public function setNum($num = null)
    {
        $this->num = $num;

        return $this;
    }

    /**
     * Get num.
     *
     * @return int|null
     */
    public function getNum()
    {
        return $this->num;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return BoardCity
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
}
