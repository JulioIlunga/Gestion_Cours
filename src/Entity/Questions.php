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
    public ?string $enonce_question = null;

   

    #[ORM\ManyToOne(targetEntity:Evaluations::class, inversedBy: 'questions')]
    private ?Evaluations $evaluations = null;

    
  

  
    

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

   

   

}
