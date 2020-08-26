<?php

namespace Yu\Board\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Board
 *
 * @ORM\Table(name="board", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})}, indexes={@ORM\Index(name="type_id", columns={"type_id"}), @ORM\Index(name="view", columns={"view"}), @ORM\Index(name="city_id", columns={"city_id"})})
 * @ORM\Entity(repositoryClass="\Yu\Board\Repository\BoardRepository")
 */
class Board
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="date", type="bigint", precision=0, scale=0, nullable=false, unique=false)
     */
    private $date;

    /**
     * @var int
     *
     * @ORM\Column(name="type_id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $typeId;

    /**
     * @var int
     *
     * @ORM\Column(name="city_id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $cityId;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="text", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $phone;

    /**
     * @var string|null
     *
     * @ORM\Column(name="person", type="text", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $person;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="text", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="string", length=1000, precision=0, scale=0, nullable=false, unique=false)
     */
    private $message;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ip", type="bigint", precision=0, scale=0, nullable=true, unique=false)
     */
    private $ip;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="view", type="boolean", precision=0, scale=0, nullable=true, unique=false)
     */
    private $view;


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
     * Set date.
     *
     * @param int $date
     *
     * @return Board
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date.
     *
     * @return int
     */
    public function getDate()
    {
        $date = new \DateTime( date('Y-m-d',$this->date) );
        return $date;
    }

    /**
     * Set typeId.
     *
     * @param int $typeId
     *
     * @return Board
     */
    public function setTypeId($typeId)
    {
        $this->typeId = $typeId;

        return $this;
    }

    /**
     * Get typeId.
     *
     * @return int
     */
    public function getTypeId()
    {
        return $this->typeId;
    }

    /**
     * Set cityId.
     *
     * @param int $cityId
     *
     * @return Board
     */
    public function setCityId($cityId)
    {
        $this->cityId = $cityId;

        return $this;
    }

    /**
     * Get cityId.
     *
     * @return int
     */
    public function getCityId()
    {
        return $this->cityId;
    }

    /**
     * Set phone.
     *
     * @param string $phone
     *
     * @return Board
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone.
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set person.
     *
     * @param string|null $person
     *
     * @return Board
     */
    public function setPerson($person = null)
    {
        $this->person = $person;

        return $this;
    }

    /**
     * Get person.
     *
     * @return string|null
     */
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * Set email.
     *
     * @param string|null $email
     *
     * @return Board
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
     * Set message.
     *
     * @param string $message
     *
     * @return Board
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message.
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set ip.
     *
     * @param int|null $ip
     *
     * @return Board
     */
    public function setIp($ip = null)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip.
     *
     * @return int|null
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set view.
     *
     * @param bool|null $view
     *
     * @return Board
     */
    public function setView($view = null)
    {
        $this->view = $view;

        return $this;
    }

    /**
     * Get view.
     *
     * @return bool|null
     */
    public function getView()
    {
        return $this->view;
    }
}
