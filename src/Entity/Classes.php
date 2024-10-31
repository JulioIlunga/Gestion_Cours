<?php

namespace App\Entity;

use App\Repository\ClassesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClassesRepository::class)]
class Classes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $level = null;

    #[ORM\Column(length: 255)]
    private ?string $section = null;
    /**
     * @ORM\OneToMany(targetEntity: Cours::class, mappedBy="classe_id")
     */
    private $cours;
    /**
     * @ORM\OneToMany(targetEntity: Students::class, mappedBy="class_id")
     */
    private $students;

    /**
     * @ORM\OneToOne(targetEntity: Students::class, mappedBy="class_id")
     */
    private $head_student;

    /**
     * @var Collection<int, Evaluations>
     */
    #[ORM\OneToMany(targetEntity: Evaluations::class, mappedBy: 'classe')]
    private Collection $evaluations;

   
   

    public function __construct()
    {
        // $this->head_student = new ArrayCollection();
        $this->students = new ArrayCollection();
        $this->cours = new ArrayCollection();
        $this->evaluations = new ArrayCollection();
        
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getLevel(): ?string
    {
        return $this->level;
    }

    public function setLevel(string $level): static
    {
        $this->level = $level;

        return $this;
    }   
    public function getSection(): ?string
    {
        return $this->section;
    }

    public function setSection(string $section): static
    {
        $this->section = $section;

        return $this;
    }
 
    public function getStudentsCount(): int
    {
        if ($this->students === null) {
            return 0;
        }

    
        return $this->students->count();
    }

    public function getHeadStudent(): ?Students // Corrigé pour retourner un seul étudiant
    {
        return $this->head_student;
    }

    public function setHeadStudent(?Students $headStudent): static 
    {
        $this->head_student = $headStudent;

        return $this;
    }

    public function removeHeadStudent(Students $headStudent): static
    {
        if ($this->head_student->removeElement($headStudent)) {
            // set the owning side to null (unless already changed)
            if ($headStudent->getClassId() === $this) {
                $headStudent->setClassId(null);
            }
        }

        return $this;
    }
 
        /**
     * @return Collection<int, Cours>
     */
    public function getCours(): Collection
    {
        if ($this->cours === null) {
            $this->cours = new ArrayCollection();
        }
        return $this->cours;
    }

//     public function addCour(Cours $cour): self
// {
//     if (!$this->cours->contains($cour)) {
//         $this->cours->add($cour);
//         $cour->setClassId($this);
//  // Assurez-vous que la relation inverse est définie
//     }

//     return $this;
// }

//     public function removeCour(Cours $cour): self
//     {
//         if ($this->cours->removeElement($cour)) {
//             // set the owning side to null (unless already changed)
//             if ($cour->getClassId() === $this) {
//                 $cour->setClassId(null);
//             }
//         }

//         return $this;
//     }

    public function __toString()
    {
        return $this->getName(); // Remplacez 'getName()' par la méthode qui retourne le nom de la classe
    }

    /**
     * @return Collection<int, Evaluations>
     */
    public function getEvaluations(): Collection
    {
        return $this->evaluations;
    }

    public function addEvaluation(Evaluations $evaluation): static
    {
        if (!$this->evaluations->contains($evaluation)) {
            $this->evaluations->add($evaluation);
            $evaluation->setClasse($this);
        }

        return $this;
    }

    public function removeEvaluation(Evaluations $evaluation): static
    {
        if ($this->evaluations->removeElement($evaluation)) {
            // set the owning side to null (unless already changed)
            if ($evaluation->getClasse() === $this) {
                $evaluation->setClasse(null);
            }
        }

        return $this;
    }

   

   

    

}
