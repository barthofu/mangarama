<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */
class Manga
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank(message="Ce champs ne peut pas être vide")
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=4000, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="decimal", nullable=true, precision=4, scale=2, options={ "default"= 0.0 })
     * @Assert\Range(
     *   min = 0,
     *   max = 10,
     *   notInRangeMessage = "Le score doit se situer entre {{ min }} et {{ max }}"
     * )
     */
    private $score;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="smallint", nullable=true, options={ "default": 0 })
     * @Assert\PositiveOrZero
     */
    private $votersNumber;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getScore(): ?float
    {
        return $this->score;
    }

    public function setScore(?float $score): self
    {
        $this->score = $score;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getVotersNumber(): ?int
    {
        return $this->votersNumber;
    }

    public function setVotersNumber(int $votersNumber): self
    {
        $this->votersNumber = $votersNumber;

        return $this;
    }
}
