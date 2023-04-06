<?php

namespace App\Entity;

use App\Repository\FicheFraisRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FicheFraisRepository::class)]
class FicheFrais
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'ficheFrais')]
    private ?Utilisateur $idUtilisateur = null;

    #[ORM\Column(length: 6)]
    private ?string $mois = null;

    #[ORM\Column]
    private ?int $nbJustificatifs = null;

    #[ORM\Column]
    private ?int $montantValide = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateModif = null;

    #[ORM\OneToOne(mappedBy: 'idFiche', cascade: ['persist', 'remove'])]
    private ?LigneFraisHorsForfait $ligneFraisHorsForfait = null;

    #[ORM\ManyToOne(inversedBy: 'ficheFrais')]
    private ?Etat $idEtat = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUtilisateur(): ?Utilisateur
    {
        return $this->idUtilisateur;
    }

    public function setIdUtilisateur(?Utilisateur $idUtilisateur): self
    {
        $this->idUtilisateur = $idUtilisateur;

        return $this;
    }

    public function getMois(): ?string
    {
        return $this->mois;
    }

    public function setMois(string $mois): self
    {
        $this->mois = $mois;

        return $this;
    }

    public function getNbJustificatifs(): ?int
    {
        return $this->nbJustificatifs;
    }

    public function setNbJustificatifs(int $nbJustificatifs): self
    {
        $this->nbJustificatifs = $nbJustificatifs;

        return $this;
    }

    public function getMontantValide(): ?int
    {
        return $this->montantValide;
    }

    public function setMontantValide(int $montantValide): self
    {
        $this->montantValide = $montantValide;

        return $this;
    }

    public function getDateModif(): ?\DateTimeInterface
    {
        return $this->dateModif;
    }

    public function setDateModif(?\DateTimeInterface $dateModif): self
    {
        $this->dateModif = $dateModif;

        return $this;
    }

    public function getLigneFraisHorsForfait(): ?LigneFraisHorsForfait
    {
        return $this->ligneFraisHorsForfait;
    }

    public function setLigneFraisHorsForfait(LigneFraisHorsForfait $ligneFraisHorsForfait): self
    {
        // set the owning side of the relation if necessary
        if ($ligneFraisHorsForfait->getIdFiche() !== $this) {
            $ligneFraisHorsForfait->setIdFiche($this);
        }

        $this->ligneFraisHorsForfait = $ligneFraisHorsForfait;

        return $this;
    }

    public function getIdEtat(): ?Etat
    {
        return $this->idEtat;
    }

    public function setIdEtat(?Etat $idEtat): self
    {
        $this->idEtat = $idEtat;

        return $this;
    }
}
