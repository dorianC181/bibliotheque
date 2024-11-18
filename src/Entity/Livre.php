<?php

namespace App\Entity;

use App\Repository\LivreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LivreRepository::class)]
class Livre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $titre = null;

    #[ORM\Column]
    private ?int $isbn = null;

    #[ORM\Column(length: 255)]
    private ?string $date = null;

    /**
     * @var Collection<int, auteur>
     */
    #[ORM\ManyToMany(targetEntity: auteur::class, inversedBy: 'livres')]
    private Collection $auteur;

    #[ORM\ManyToOne(inversedBy: 'livres')]
    #[ORM\JoinColumn(nullable: false)]
    private ?GenreLitteraire $genre = null;

    #[ORM\ManyToOne(inversedBy: 'livre_emprunt')]
    private ?Utilisateurs $utilisateurs = null;

    #[ORM\ManyToOne(inversedBy: 'livres')]
    private ?User $emprunt = null;

    public function __construct()
    {
        $this->auteur = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getIsbn(): ?int
    {
        return $this->isbn;
    }

    public function setIsbn(int $isbn): static
    {
        $this->isbn = $isbn;

        return $this;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date): static
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Collection<int, auteur>
     */
    public function getAuteur(): Collection
    {
        return $this->auteur;
    }

    public function addAuteur(auteur $auteur): static
    {
        if (!$this->auteur->contains($auteur)) {
            $this->auteur->add($auteur);
        }

        return $this;
    }

    public function removeAuteur(auteur $auteur): static
    {
        $this->auteur->removeElement($auteur);

        return $this;
    }

    public function getGenre(): ?GenreLitteraire
    {
        return $this->genre;
    }

    public function setGenre(?GenreLitteraire $genre): static
    {
        $this->genre = $genre;

        return $this;
    }

    public function getUtilisateurs(): ?Utilisateurs
    {
        return $this->utilisateurs;
    }

    public function setUtilisateurs(?Utilisateurs $utilisateurs): static
    {
        $this->utilisateurs = $utilisateurs;

        return $this;
    }

    public function getEmprunt(): ?User
    {
        return $this->emprunt;
    }

    public function setEmprunt(?User $emprunt): static
    {
        $this->emprunt = $emprunt;

        return $this;
    }
}
