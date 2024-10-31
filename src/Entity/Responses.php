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

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?questions $question = null;

    #[ORM\ManyToOne]
    private ?TypeResponses $type_response = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestion(): ?questions
    {
        return $this->question;
    }

    public function setQuestion(?questions $question): static
    {
        $this->question = $question;

        return $this;
    }

    public function getTypeResponse(): ?TypeResponses
    {
        return $this->type_response;
    }

    public function setTypeResponse(?TypeResponses $type_response): static
    {
        $this->type_response = $type_response;

        return $this;
    }
}
