<?php

namespace App\Entity;

use App\Repository\DifficulteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DifficulteRepository::class)]
class Difficulte
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $libelle = null;

    /**
     * @var Collection<int, question>
     */
    #[ORM\OneToMany(targetEntity: question::class, mappedBy: 'difficulte')]
    private Collection $difficulte_question;

    /**
     * @var Collection<int, Evaluation>
     */
    #[ORM\OneToMany(targetEntity: Evaluation::class, mappedBy: 'difficulte_eval', orphanRemoval: true)]
    private Collection $id_evaluation;

    public function __construct()
    {
        $this->difficulte_question = new ArrayCollection();
        $this->id_evaluation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection<int, question>
     */
    public function getDifficulteQuestion(): Collection
    {
        return $this->difficulte_question;
    }

    public function addDifficulteQuestion(question $difficulteQuestion): static
    {
        if (!$this->difficulte_question->contains($difficulteQuestion)) {
            $this->difficulte_question->add($difficulteQuestion);
            $difficulteQuestion->setDifficulte($this);
        }

        return $this;
    }

    public function removeDifficulteQuestion(question $difficulteQuestion): static
    {
        if ($this->difficulte_question->removeElement($difficulteQuestion)) {
            // set the owning side to null (unless already changed)
            if ($difficulteQuestion->getDifficulte() === $this) {
                $difficulteQuestion->setDifficulte(null);
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
            $idEvaluation->setDifficulteEval($this);
        }

        return $this;
    }

    public function removeIdEvaluation(Evaluation $idEvaluation): static
    {
        if ($this->id_evaluation->removeElement($idEvaluation)) {
            // set the owning side to null (unless already changed)
            if ($idEvaluation->getDifficulteEval() === $this) {
                $idEvaluation->setDifficulteEval(null);
            }
        }

        return $this;
    }
}
