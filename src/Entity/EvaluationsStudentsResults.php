<?php

namespace App\Entity;

use App\Repository\EvaluationsStudentsResultsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EvaluationsStudentsResultsRepository::class)]
class EvaluationsStudentsResults
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'results_evaluations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Students $student_id = null;

    /**
     * @var Collection<int, Evaluations>
     */
    #[ORM\ManyToMany(targetEntity: Evaluations::class)]
    private Collection $evaluation_id;

    public function __construct()
    {
        $this->evaluation_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStudentId(): ?Students
    {
        return $this->student_id;
    }

    public function setStudentId(?Students $student_id): static
    {
        $this->student_id = $student_id;

        return $this;
    }

    /**
     * @return Collection<int, Evaluations>
     */
    public function getEvaluationId(): Collection
    {
        return $this->evaluation_id;
    }

    public function addEvaluationId(Evaluations $evaluationId): static
    {
        if (!$this->evaluation_id->contains($evaluationId)) {
            $this->evaluation_id->add($evaluationId);
        }

        return $this;
    }

    public function removeEvaluationId(Evaluations $evaluationId): static
    {
        $this->evaluation_id->removeElement($evaluationId);

        return $this;
    }
}
