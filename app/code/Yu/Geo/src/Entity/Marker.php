<?php

namespace Yu\Geo\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Marker
 *
 * @ORM\Table(name="marker", indexes={@ORM\Index(name="path_id", columns={"path_id"}), @ORM\Index(name="path", columns={"path"}), @ORM\Index(name="path_2", columns={"path", "path_id"})})
 * @ORM\Entity(repositoryClass="\Yu\Geo\Repository\MarkerRepository")
 */
class Marker
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
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=10, precision=0, scale=0, nullable=false, unique=false)
     */
    private $path;

    /**
     * @var int
     *
     * @ORM\Column(name="path_id", type="integer", precision=0, scale=0, nullable=false, options={"unsigned"=true}, unique=false)
     */
    private $pathId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="address", type="string", length=200, precision=0, scale=0, nullable=true, unique=false)
     */
    private $address;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mark", type="string", length=200, precision=0, scale=0, nullable=true, unique=false)
     */
    private $mark;

    /**
     * @var float|null
     *
     * @ORM\Column(name="lat", type="float", precision=10, scale=6, nullable=true, unique=false)
     */
    private $lat;

    /**
     * @var float|null
     *
     * @ORM\Column(name="lng", type="float", precision=10, scale=6, nullable=true, unique=false)
     */
    private $lng;


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
     * Set path.
     *
     * @param string $path
     *
     * @return Marker
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
     * Set pathid.
     *
     * @param int $pathid
     *
     * @return Marker
     */
    public function setPathId($pathId)
    {
        $this->pathId = $pathId;

        return $this;
    }

    /**
     * Get pathid.
     *
     * @return int
     */
    public function getPathId()
    {
        return $this->pathId;
    }

    /**
     * Set address.
     *
     * @param string|null $address
     *
     * @return Marker
     */
    public function setAddress($address = null)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address.
     *
     * @return string|null
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set mark.
     *
     * @param string|null $mark
     *
     * @return Marker
     */
    public function setMark($mark = null)
    {
        $this->mark = $mark;

        return $this;
    }

    /**
     * Get mark.
     *
     * @return string|null
     */
    public function getMark()
    {
        return $this->mark;
    }

    /**
     * Set lat.
     *
     * @param float|null $lat
     *
     * @return Marker
     */
    public function setLat($lat = null)
    {
        $this->lat = $lat;

        return $this;
    }

    /**
     * Get lat.
     *
     * @return float|null
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * Set lng.
     *
     * @param float|null $lng
     *
     * @return Marker
     */
    public function setLng($lng = null)
    {
        $this->lng = $lng;

        return $this;
    }

    /**
     * Get lng.
     *
     * @return float|null
     */
    public function getLng()
    {
        return $this->lng;
    }
}
