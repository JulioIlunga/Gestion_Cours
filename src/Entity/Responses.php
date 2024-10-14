<?php

namespace App\Entity;

use App\Repository\ResponsesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ResponsesRepository::class)]
class Responses
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'response_id')]
    private ?Questions $question_id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?TypeResponses $type_response_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestionId(): ?Questions
    {
        return $this->question_id;
    }

    public function setQuestionId(?Questions $question_id): static
    {
        $this->question_id = $question_id;

        return $this;
    }

    public function getTypeResponseId(): ?TypeResponses
    {
        return $this->type_response_id;
    }

    public function setTypeResponseId(?TypeResponses $type_response_id): static
    {
        $this->type_response_id = $type_response_id;

        return $this;
    }
}
