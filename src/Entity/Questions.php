<?php

namespace App\Entity;

use App\Repository\QuestionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionsRepository::class)]
class Questions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $enonce_question = null;

    /**
     * @var Collection<int, Responses>
     */
    #[ORM\OneToMany(targetEntity: Responses::class, mappedBy: 'question_id')]
    private Collection $response_id;

    /**
     * @var Collection<int, Evaluations>
     */
    #[ORM\ManyToMany(targetEntity: Evaluations::class, mappedBy: 'question_id')]
    private Collection $evaluation_id;

    public function __construct()
    {
        $this->response_id = new ArrayCollection();
        $this->evaluation_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEnonceQuestion(): ?string
    {
        return $this->enonce_question;
    }

    public function setEnonceQuestion(string $enonce_question): static
    {
        $this->enonce_question = $enonce_question;

        return $this;
    }

    /**
     * @return Collection<int, Responses>
     */
    public function getResponseId(): Collection
    {
        return $this->response_id;
    }

    public function addResponseId(Responses $responseId): static
    {
        if (!$this->response_id->contains($responseId)) {
            $this->response_id->add($responseId);
            $responseId->setQuestionId($this);
        }

        return $this;
    }

    public function removeResponseId(Responses $responseId): static
    {
        if ($this->response_id->removeElement($responseId)) {
            // set the owning side to null (unless already changed)
            if ($responseId->getQuestionId() === $this) {
                $responseId->setQuestionId(null);
            }
        }

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
            $evaluationId->addQuestionId($this);
        }

        return $this;
    }

    public function removeEvaluationId(Evaluations $evaluationId): static
    {
        if ($this->evaluation_id->removeElement($evaluationId)) {
            $evaluationId->removeQuestionId($this);
        }

        return $this;
    }
}
