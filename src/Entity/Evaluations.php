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

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Cours $cours_id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $start_at = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $end_at = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?EvaluationTypes $evaluation_type = null;

    /**
     * @var Collection<int, Questions>
     */
    #[ORM\ManyToMany(targetEntity: Questions::class, inversedBy: 'evaluation_id')]
    private Collection $question_id;

    #[ORM\Column]
    private ?int $max_points = null;

    public function __construct()
    {
        $this->class_id = new ArrayCollection();
        $this->question_id = new ArrayCollection();
    }

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

    public function getCoursId(): ?Cours
    {
        return $this->cours_id;
    }

    public function setCoursId(?Cours $cours_id): static
    {
        $this->cours_id = $cours_id;

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

    public function getEvaluationType(): ?EvaluationTypes
    {
        return $this->evaluation_type;
    }

    public function setEvaluationType(?EvaluationTypes $evaluation_type): static
    {
        $this->evaluation_type = $evaluation_type;

        return $this;
    }

    /**
     * @return Collection<int, Questions>
     */
    public function getQuestionId(): Collection
    {
        return $this->question_id;
    }

    public function addQuestionId(Questions $questionId): static
    {
        if (!$this->question_id->contains($questionId)) {
            $this->question_id->add($questionId);
        }

        return $this;
    }

    public function removeQuestionId(Questions $questionId): static
    {
        $this->question_id->removeElement($questionId);

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
