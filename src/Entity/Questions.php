<?php

namespace App\Entity;

use App\Repository\QuestionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionsRepository::class)]
class Questions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    public ?string $enonce_question = null;

   /**
     * @ORM\Column(type="string")
     */
    private $type;

    #[ORM\ManyToOne(targetEntity:Evaluations::class, inversedBy: 'questions')]
    private ?Evaluations $evaluations = null;

    #[ORM\Column(type: Types::SIMPLE_ARRAY, nullable: true)]
    private ?array $assertions = null;

   
    

    

public function __construct()
{
    
}




    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
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

   
    
    public function getEvaluations(): ?Evaluations
    {
        return $this->evaluations;
    }

    public function setEvaluations(?Evaluations $evaluations): static
    {
        $this->evaluations = $evaluations;

        return $this;
    }

    public function getAssertions(): ?array
    {
        return $this->assertions;
    }

    public function setAssertions(?array $assertions): static
    {
        $this->assertions = $assertions;

        return $this;
    }

    
    public function addAssertion(string $assertion): self
    {
        $this->assertions[] = $assertion;
        return $this;
    }

    public function removeAssertion(string $assertion): self
    {
        if (($key = array_search($assertion, $this->assertions, true)) !== false) {
            unset($this->assertions[$key]);
            $this->assertions = array_values($this->assertions);
        }
        return $this;
    }

    

    

   

}
