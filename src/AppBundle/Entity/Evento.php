<?php
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\MappedSuperclass
 */
class Evento {

    /**
     * @ORM\Column(type="boolean", nullable=false)
     *
     * @var boolean
     */
    protected $favorito = 0;
    /**
     * @ORM\Column(type="datetime", nullable=false)
     *
     * @var \DateTime
     */
    protected $fechaEvento;
    /**
     * @ORM\Column(type="datetime", nullable=false)
     *
     * @var \DateTime
     */
    protected $fechaCreado;

    /**
     * @return bool
     */
    public function isFavorito()
    {
        return $this->favorito;
    }

    /**
     * @param bool $favorito
     */
    public function setFavorito($favorito)
    {
        $this->favorito = $favorito;
    }

    /**
     * @return \DateTime
     */
    public function getFechaEvento()
    {
        return $this->fechaEvento;
    }

    /**
     * @param \DateTime $fechaEvento
     */
    public function setFechaEvento($fechaEvento)
    {
        $this->fechaEvento = $fechaEvento;
    }

    /**
     * @return \DateTime
     */
    public function getFechaCreado()
    {
        return $this->fechaCreado;
    }

    /**
     * @param \DateTime $fechaCreado
     */
    public function setFechaCreado($fechaCreado)
    {
        $this->fechaCreado = $fechaCreado;
    }

}