<?php

namespace App\Entity;

use App\Repository\ChapitreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChapitreRepository::class)]
class Chapitre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $contenu = null;

    /**
     * @var Collection<int, question>
     */
    #[ORM\OneToMany(targetEntity: question::class, mappedBy: 'chapitre', orphanRemoval: true)]
    private Collection $chapitre_question;

    #[ORM\ManyToOne(inversedBy: 'theme_chapitre')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Theme $theme = null;

    public function __construct()
    {
        $this->chapitre_question = new ArrayCollection();
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
     * @return Collection<int, question>
     */
    public function getChapitreQuestion(): Collection
    {
        return $this->chapitre_question;
    }

    public function addChapitreQuestion(question $chapitreQuestion): static
    {
        if (!$this->chapitre_question->contains($chapitreQuestion)) {
            $this->chapitre_question->add($chapitreQuestion);
            $chapitreQuestion->setChapitre($this);
        }

        return $this;
    }

    public function removeChapitreQuestion(question $chapitreQuestion): static
    {
        if ($this->chapitre_question->removeElement($chapitreQuestion)) {
            // set the owning side to null (unless already changed)
            if ($chapitreQuestion->getChapitre() === $this) {
                $chapitreQuestion->setChapitre(null);
            }
        }

        return $this;
    }

    public function getTheme(): ?Theme
    {
        return $this->theme;
    }

    public function setTheme(?Theme $theme): static
    {
        $this->theme = $theme;

        return $this;
    }
}
