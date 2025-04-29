<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\Evaluation;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
class Utilisateur implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    #[ORM\Column(length: 100)]
    private ?string $prenom = null;

    #[ORM\Column(length: 512, nullable: true)]
    private ?string $photo = null;

    #[ORM\Column(length: 50)]
    private ?string $token = null;

    #[ORM\Column]
    private ?int $nb_questions = null;

    #[ORM\Column]
    private ?int $nb_eval = null;

    /**
     * @var Collection<int, Question>
     */
    #[ORM\OneToMany(targetEntity: Question::class, mappedBy: 'question_utilisateur')]
    private Collection $id_question;

    /**
     * @var Collection<int, Evaluation>
     */
    
    #[ORM\OneToMany(targetEntity: Evaluation::class, mappedBy: 'evaluation_utilisateur', orphanRemoval: true)]
    private Collection $id_evaluation;
    
    //private $id_evaluation;

    public function __construct()
    {
        $this->id_question = new ArrayCollection();
        $this->id_evaluation = new ArrayCollection();
        //$this->id_evaluation = [];
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): static
    {
        $this->photo = $photo;

        return $this;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(string $token): static
    {
        $this->token = $token;

        return $this;
    }

    public function getNbQuestions(): ?int
    {
        return $this->nb_questions;
    }

    public function setNbQuestions(int $nb_questions): static
    {
        $this->nb_questions = $nb_questions;

        return $this;
    }

    public function getNbEval(): ?int
    {
        return $this->nb_eval;
    }

    public function setNbEval(int $nb_eval): static
    {
        $this->nb_eval = $nb_eval;

        return $this;
    }

    /**
     * @return Collection<int, Question>
     */
    public function getIdQuestion(): Collection
    {
        return $this->id_question;
    }

    public function addIdQuestion(Question $idQuestion): static
    {
        if (!$this->id_question->contains($idQuestion)) {
            $this->id_question->add($idQuestion);
            $idQuestion->setQuestionUtilisateur($this);
        }

        return $this;
    }

    public function removeIdQuestion(Question $idQuestion): static
    {
        if ($this->id_question->removeElement($idQuestion)) {
            // set the owning side to null (unless already changed)
            if ($idQuestion->getQuestionUtilisateur() === $this) {
                $idQuestion->setQuestionUtilisateur(null);
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
        //return [];
    }

    public function addIdEvaluation(Evaluation $idEvaluation): static
    {
        if (!$this->id_evaluation->contains($idEvaluation)) {
            $this->id_evaluation->add($idEvaluation);
            $idEvaluation->setEvaluationUtilisateur($this);
        }


        return $this;
    }

    public function removeIdEvaluation(Evaluation $idEvaluation): static
    {
        if ($this->id_evaluation->removeElement($idEvaluation)) {
            // set the owning side to null (unless already changed)
            if ($idEvaluation->getEvaluationUtilisateur() === $this) {
                $idEvaluation->setEvaluationUtilisateur(null);
            }
        }

        return $this;
    }
}
