<?php

namespace App\Entity;

use App\Repository\EvaluationsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EvaluationsRepository::class)]
class Evaluations
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

   

   
  

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $start_at = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)] 
    private ?\DateTimeInterface $end_at = null;
 
    #[ORM\Column(length: 255)]

    private ?string $evaluation_type = null;

    #[ORM\Column(length: 255)]

    private ?string $nom_evaluation = null;


    #[ORM\Column]
    private ?int $max_points = null;

   

    #[ORM\ManyToOne]
    private ?Cours $cours = null;

    #[ORM\ManyToOne(inversedBy: 'evaluations')]
    private ?Classes $classe = null;

    /**
     * @var Collection<int, Questions>
     */
    #[ORM\OneToMany(targetEntity: Questions::class, mappedBy: 'evaluations')]
    private Collection $questions;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
    }

   

   

    

    public function getId(): ?int  
    {
        return $this->id;
    }

    

    public function getStartAt(): ?\DateTimeInterface
    {
        return $this->start_at;
    }

    public function setStartAt(\DateTimeInterface $start_at): static
    {
        $this->start_at = $start_at;

        return $this;
    }

    public function getEndAt(): ?\DateTimeInterface
    {
        return $this->end_at;
    }

    public function setEndAt(\DateTimeInterface $end_at): static
    {
        $this->end_at = $end_at;

        return $this;
    }

    public function getEvaluationType(): ?string
    {
        return $this->evaluation_type;
    }

    public function setEvaluationType(string $evaluation_type): static
    {
        $this->evaluation_type = $evaluation_type;

        return $this;
    }
    public function getNomEvaluation(): ?string
    {
        return $this->nom_evaluation;
    }

    public function setNomEvaluation(string $nom_evaluation): static
    {
        $this->nom_evaluation = $nom_evaluation;

        return $this;
    }
   

  

 

    public function getMaxPoints(): ?int
    {
        return $this->max_points;
    }

    public function setMaxPoints(int $max_points): static
    {
        $this->max_points = $max_points;

        return $this;
    }

    

  

    public function getCours(): ?Cours
    {
        return $this->cours;
    }

    public function setCours(?Cours $cours): static
    {
        $this->cours = $cours;

        return $this;
    }

    public function getClasse(): ?Classes
    {
        return $this->classe;
    }

    public function setClasse(?Classes $classe): static
    {
        $this->classe = $classe;

        return $this;
    }

    /**
     * @return Collection<int, Questions>
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Questions $question): static
    {
        if (!$this->questions->contains($question)) {
            $this->questions->add($question);
            $question->setEvaluations($this);
        }

        return $this;
    }

    public function removeQuestion(Questions $question): static
    {
        if ($this->questions->removeElement($question)) {
            // set the owning side to null (unless already changed)
            if ($question->getEvaluations() === $this) {
                $question->setEvaluations(null);
            }
        }

        return $this;
    }

 
}
