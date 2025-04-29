<?php

namespace App\Entity;

use App\Repository\EvaluationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EvaluationRepository::class)]
class Evaluation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 64)]
    private ?string $titre = null;

    #[ORM\Column]
    private ?bool $is_calculatrice = null;

    #[ORM\Column]
    private ?bool $is_ordinateur = null;

    #[ORM\Column]
    private ?bool $is_document = null;

    #[ORM\Column(length: 255)]
    private ?string $autre_modalite = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $introduction = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_heure = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_creation = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $duree = null;

    #[ORM\Column]
    private ?bool $is_active = null;

    #[ORM\ManyToOne(inversedBy: 'id_evaluation')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Theme $theme_eval = null;

    #[ORM\ManyToOne(inversedBy: 'id_evaluation')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Difficulte $difficulte_eval = null;

    #[ORM\ManyToOne(inversedBy: 'id_evaluation')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $evaluation_utilisateur = null;

    /**
     * @var Collection<int, Question>
     */
    #[ORM\ManyToMany(targetEntity: Question::class)]
    private Collection $question_evaluation;

    public function __construct()
    {
        $this->question_evaluation = new ArrayCollection();
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

    public function isCalculatrice(): ?bool
    {
        return $this->is_calculatrice;
    }

    public function setIsCalculatrice(bool $is_calculatrice): static
    {
        $this->is_calculatrice = $is_calculatrice;

        return $this;
    }

    public function isOrdinateur(): ?bool
    {
        return $this->is_ordinateur;
    }

    public function setIsOrdinateur(bool $is_ordinateur): static
    {
        $this->is_ordinateur = $is_ordinateur;

        return $this;
    }

    public function isDocument(): ?bool
    {
        return $this->is_document;
    }

    public function setIsDocument(bool $is_document): static
    {
        $this->is_document = $is_document;

        return $this;
    }

    public function getAutreModalite(): ?string
    {
        return $this->autre_modalite;
    }

    public function setAutreModalite(string $autre_modalite): static
    {
        $this->autre_modalite = $autre_modalite;

        return $this;
    }

    public function getIntroduction(): ?string
    {
        return $this->introduction;
    }

    public function setIntroduction(string $introduction): static
    {
        $this->introduction = $introduction;

        return $this;
    }

    public function getDateHeure(): ?\DateTimeInterface
    {
        return $this->date_heure;
    }

    public function setDateHeure(\DateTimeInterface $date_heure): static
    {
        $this->date_heure = $date_heure;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->date_creation;
    }

    public function setDateCreation(\DateTimeInterface $date_creation): static
    {
        $this->date_creation = $date_creation;

        return $this;
    }

    public function getDuree(): ?\DateTimeInterface
    {
        return $this->duree;
    }

    public function setDuree(\DateTimeInterface $duree): static
    {
        $this->duree = $duree;

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

    public function getThemeEval(): ?Theme
    {
        return $this->theme_eval;
    }

    public function setThemeEval(?Theme $theme_eval): static
    {
        $this->theme_eval = $theme_eval;

        return $this;
    }

    public function getDifficulteEval(): ?Difficulte
    {
        return $this->difficulte_eval;
    }

    public function setDifficulteEval(?Difficulte $difficulte_eval): static
    {
        $this->difficulte_eval = $difficulte_eval;

        return $this;
    }

    public function getEvaluationUtilisateur(): ?Utilisateur
    {
        return $this->evaluation_utilisateur;
    }

    public function setEvaluationUtilisateur(?Utilisateur $evaluation_utilisateur): static
    {
        $this->evaluation_utilisateur = $evaluation_utilisateur;

        return $this;
    }

    /**
     * @return Collection<int, Question>
     */
    public function getQuestionEvaluation(): Collection
    {
        return $this->question_evaluation;
    }

    public function addQuestionEvaluation(Question $questionEvaluation): static
    {
        if (!$this->question_evaluation->contains($questionEvaluation)) {
            $this->question_evaluation->add($questionEvaluation);
        }

        return $this;
    }

    public function removeQuestionEvaluation(Question $questionEvaluation): static
    {
        $this->question_evaluation->removeElement($questionEvaluation);

        return $this;
    }
}
