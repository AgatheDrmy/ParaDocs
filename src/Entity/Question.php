<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionRepository::class)]
class Question
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 512)]
    private ?string $enonce = null;

    #[ORM\Column(length: 512, nullable: true)]
    private ?string $image = null;

    #[ORM\Column]
    private ?bool $is_active = null;

    #[ORM\ManyToOne(inversedBy: 'type')]
    #[ORM\JoinColumn(nullable: false)]
    private ?type $type_question = null;

    /**
     * @var Collection<int, proposition>
     */
    #[ORM\OneToMany(targetEntity: proposition::class, mappedBy: 'id_question', orphanRemoval: true)]
    private Collection $proposition_question;

    #[ORM\ManyToOne(inversedBy: 'difficulte_question')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Difficulte $difficulte = null;

    #[ORM\ManyToOne(inversedBy: 'id_question')]
    #[ORM\JoinColumn(nullable: false)]
    private ?utilisateur $question_utilisateur = null;

    #[ORM\ManyToOne(inversedBy: 'chapitre_question')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Chapitre $chapitre = null;

    public function __construct()
    {
        $this->proposition_question = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEnonce(): ?string
    {
        return $this->enonce;
    }

    public function setEnonce(string $enonce): static
    {
        $this->enonce = $enonce;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->is_active;
    }

    public function setIsActive(bool $is_active): static
    {
        $this->is_active = $is_active;

        return $this;
    }

    public function getTypeQuestion(): ?type
    {
        return $this->type_question;
    }

    public function setTypeQuestion(?type $type_question): static
    {
        $this->type_question = $type_question;

        return $this;
    }

    /**
     * @return Collection<int, proposition>
     */
    public function getPropositionQuestion(): Collection
    {
        return $this->proposition_question;
    }

    public function addPropositionQuestion(proposition $propositionQuestion): static
    {
        if (!$this->proposition_question->contains($propositionQuestion)) {
            $this->proposition_question->add($propositionQuestion);
            $propositionQuestion->setIdQuestion($this);
        }

        return $this;
    }

    public function removePropositionQuestion(proposition $propositionQuestion): static
    {
        if ($this->proposition_question->removeElement($propositionQuestion)) {
            // set the owning side to null (unless already changed)
            if ($propositionQuestion->getIdQuestion() === $this) {
                $propositionQuestion->setIdQuestion(null);
            }
        }

        return $this;
    }

    public function getDifficulte(): ?Difficulte
    {
        return $this->difficulte;
    }

    public function setDifficulte(?Difficulte $difficulte): static
    {
        $this->difficulte = $difficulte;

        return $this;
    }

    public function getQuestionUtilisateur(): ?utilisateur
    {
        return $this->question_utilisateur;
    }

    public function setQuestionUtilisateur(?utilisateur $question_utilisateur): static
    {
        $this->question_utilisateur = $question_utilisateur;

        return $this;
    }

    public function getChapitre(): ?Chapitre
    {
        return $this->chapitre;
    }

    public function setChapitre(?Chapitre $chapitre): static
    {
        $this->chapitre = $chapitre;

        return $this;
    }
}
