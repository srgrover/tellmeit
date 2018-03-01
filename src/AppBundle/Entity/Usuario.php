<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="Usuario")
 * @UniqueEntity("email")
 */
class Usuario extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="boolean", nullable=false)
     *
     * @var boolean
     */
    protected $admin = false;
    /**
     * @ORM\Column(type="boolean", nullable=false)
     *
     * @var boolean
     */
    protected $validator = false;
    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     *
     * @Assert\NotBlank(message="Por favor, introduce tu nombre.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="El nombre es demasiado corto. Introduce como mínimo 3 caracteres.",
     *     maxMessage="El nombre es demasiado largo, no debe sobrepasar los 255 caracteres.",
     *     groups={"Registration", "Profile"}
     * )
     */
    protected $nombre;
    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     *
     * @Assert\NotBlank(message="Por favor, introduce al menos un apellido.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="El/los apellido/s son demasiado cortos",
     *     maxMessage="El/los apellido/s son demasiado largos",
     *     groups={"Registration", "Profile"}
     * )
     */
    protected $apellidos;
    /**
     * @ORM\Column(type="date", nullable=true)
     *
     * @var /date
     */
    protected $fechaNacimiento;
    /**
     * @ORM\Column(type="string", nullable=true)
     *
     * @var string
     */
    protected $imagenPerfil;
    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    protected $activacion;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Deporte", mappedBy="usuario")
     *
     * @var Deporte
     */
    protected $deportes;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Entretenimiento", mappedBy="usuario")
     *
     * @var Entretenimiento
     */
    protected $entretenimientos;

    public function __construct()
    {
        parent::__construct();
    }

    public function getUsername()
    {
        return $this->email;
    }
    public function getSalt()
    {
        return null;
    }
    public function getRoles()
    {
        $roles = ["ROLE_USER"];     //Todos los usuarios son ROLE_USER
        if($this->isAdmin()){
            $roles[] = "ROLE_ADMIN";
        }
        if($this->isValidator()){
            $roles[] = "ROLE_VALIDATOR";
        }
        return $roles;
    }
    public function eraseCredentials()
    {
    }

    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->email,
            $this->password
        ));
    }
    public function  unserialize($serialized)
    {
        list(
            $this->id,
            $this->email,
            $this->password
            ) = unserialize($serialized);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return bool
     */
    public function isAdmin()
    {
        return $this->admin;
    }

    /**
     * @param bool $admin
     */
    public function setAdmin($admin)
    {
        $this->admin = $admin;
    }

    /**
     * @return bool
     */
    public function isValidator()
    {
        return $this->validator;
    }

    /**
     * @param bool $validator
     */
    public function setValidator($validator)
    {
        $this->validator = $validator;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * @param mixed $apellidos
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;
    }

    /**
     * @return mixed
     */
    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    /**
     * @param mixed $fechaNacimiento
     */
    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;
    }

    /**
     * @return string
     */
    public function getImagenPerfil()
    {
        return $this->imagenPerfil;
    }

    /**
     * @param string $imagenPerfil
     */
    public function setImagenPerfil($imagenPerfil)
    {
        $this->imagenPerfil = $imagenPerfil;
    }

    /**
     * @return \DateTime
     */
    public function getActivacion()
    {
        return $this->activacion;
    }

    /**
     * @param \DateTime $activacion
     */
    public function setActivacion($activacion)
    {
        $this->activacion = $activacion;
    }


}