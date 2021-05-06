<?php

namespace App\Entity;

use App\Repository\RecetasRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RecetasRepository::class)
 */
class Recetas
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $receta;

    /**
     * @ORM\Column(type="string", length=3000)
     */
    private $ingredientes;

    /**
     * @ORM\Column(type="string", length=3000)
     */
    private $preparacion;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imagen;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $categoria;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="recetas")
     */
    private $user;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReceta(): ?string
    {
        return $this->receta;
    }

    public function setReceta(string $receta): self
    {
        $this->receta = $receta;

        return $this;
    }

    public function getIngredientes(): ?string
    {
        return $this->ingredientes;
    }

    public function setIngredientes(string $ingredientes): self
    {
        $this->ingredientes = $ingredientes;

        return $this;
    }

    public function getPreparacion(): ?string
    {
        return $this->preparacion;
    }

    public function setPreparacion(string $preparacion): self
    {
        $this->preparacion = $preparacion;

        return $this;
    }

    public function getImagen(): ?string
    {
        return $this->imagen;
    }

    public function setImagen(string $imagen): self
    {
        $this->imagen = $imagen;

        return $this;
    }

    public function getCategoria(): ?string
    {
        return $this->categoria;
    }

    public function setCategoria(string $categoria): self
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }


}
