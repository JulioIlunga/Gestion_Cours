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

    /**
     * @var Collection<int, Classes>
     */
    #[ORM\ManyToMany(targetEntity: Classes::class)]
    private Collection $class_id;

  

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

    

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Classes>
     */
    public function getClassId(): Collection
    {
        return $this->class_id;
    }

    public function addClassId(Classes $classId): static
    {
        if (!$this->class_id->contains($classId)) {
            $this->class_id->add($classId);
        }

        return $this;
    }

    public function removeClassId(Classes $classId): static
    {
        $this->class_id->removeElement($classId);

        return $this;
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
}
