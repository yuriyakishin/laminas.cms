<?php

namespace Yu\Board\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BoardType
 *
 * @ORM\Table(name="board_type", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})})
 * @ORM\Entity(repositoryClass="\Yu\Board\Repository\BoardTypeRepository")
 */
class BoardType
{
    /**
     * @var bool
     *
     * @ORM\Column(name="id", type="integer", precision=0, scale=0, nullable=false, unique=false)
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
     * @ORM\Column(name="name", type="string", length=100, precision=0, scale=0, nullable=false, unique=false)
     */
    private $name;


    /**
     * Get id.
     *
     * @return bool
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
     * @return BoardType
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
     * @return BoardType
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
