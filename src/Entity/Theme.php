<?php

namespace App\Entity;

use App\Repository\ThemeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ThemeRepository::class)]
class Theme
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $contenu = null;

    /**
     * @var Collection<int, chapitre>
     */
    #[ORM\OneToMany(targetEntity: chapitre::class, mappedBy: 'theme', orphanRemoval: true)]
    private Collection $theme_chapitre;

    /**
     * @var Collection<int, Evaluation>
     */
    #[ORM\OneToMany(targetEntity: Evaluation::class, mappedBy: 'theme_eval', orphanRemoval: true)]
    private Collection $id_evaluation;

    public function __construct()
    {
        $this->theme_chapitre = new ArrayCollection();
        $this->id_evaluation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): static
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * @return Collection<int, chapitre>
     */
    public function getThemeChapitre(): Collection
    {
        return $this->theme_chapitre;
    }

    public function addThemeChapitre(chapitre $themeChapitre): static
    {
        if (!$this->theme_chapitre->contains($themeChapitre)) {
            $this->theme_chapitre->add($themeChapitre);
            $themeChapitre->setTheme($this);
        }

        return $this;
    }

    public function removeThemeChapitre(chapitre $themeChapitre): static
    {
        if ($this->theme_chapitre->removeElement($themeChapitre)) {
            // set the owning side to null (unless already changed)
            if ($themeChapitre->getTheme() === $this) {
                $themeChapitre->setTheme(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Evaluation>
     */
    public function getIdEvaluation(): Collection
    {
        return $this->id_evaluation;
    }

    public function addIdEvaluation(Evaluation $idEvaluation): static
    {
        if (!$this->id_evaluation->contains($idEvaluation)) {
            $this->id_evaluation->add($idEvaluation);
            $idEvaluation->setThemeEval($this);
        }

        return $this;
    }

    public function removeIdEvaluation(Evaluation $idEvaluation): static
    {
        if ($this->id_evaluation->removeElement($idEvaluation)) {
            // set the owning side to null (unless already changed)
            if ($idEvaluation->getThemeEval() === $this) {
                $idEvaluation->setThemeEval(null);
            }
        }

        return $this;
    }
}
