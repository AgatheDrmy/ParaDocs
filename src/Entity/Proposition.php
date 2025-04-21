<?php

namespace App\Entity;

use App\Repository\PropositionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PropositionRepository::class)]
class Proposition
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $contenu = null;

    #[ORM\Column]
    private ?bool $is_correcte = null;

    #[ORM\ManyToOne(inversedBy: 'proposition_question')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Question $id_question = null;

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

    public function isCorrecte(): ?bool
    {
        return $this->is_correcte;
    }

    public function setIsCorrecte(bool $is_correcte): static
    {
        $this->is_correcte = $is_correcte;

        return $this;
    }

    public function getIdQuestion(): ?Question
    {
        return $this->id_question;
    }

    public function setIdQuestion(?Question $id_question): static
    {
        $this->id_question = $id_question;

        return $this;
    }
}
