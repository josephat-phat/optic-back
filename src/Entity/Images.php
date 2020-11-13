<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\ImagesRepository")
 */
class Images
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imagejpg;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imagesvg;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $taxeCouleur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Produit", inversedBy="images")
     * @ORM\JoinColumn(nullable=false)
     */
    private $produit;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImagejpg(): ?string
    {
        return $this->imagejpg;
    }

    public function setImagejpg(string $imagejpg): self
    {
        $this->imagejpg = $imagejpg;

        return $this;
    }

    public function getImagesvg(): ?string
    {
        return $this->imagesvg;
    }

    public function setImagesvg(string $imagesvg): self
    {
        $this->imagesvg = $imagesvg;

        return $this;
    }

    public function getTaxeCouleur(): ?string
    {
        return $this->taxeCouleur;
    }

    public function setTaxeCouleur(string $taxeCouleur): self
    {
        $this->taxeCouleur = $taxeCouleur;

        return $this;
    }

    public function getProduit(): ?Produit
    {
        return $this->produit;
    }

    public function setProduit(?Produit $produit): self
    {
        $this->produit = $produit;

        return $this;
    }
}