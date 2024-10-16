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

    #[ORM\Column]
    private ?int $students_nbr = null;

    /**
     * @var Collection<int, Students>
     */
    #[ORM\OneToMany(targetEntity: Students::class, mappedBy: 'class_id')]
    private Collection $head_student;

    public function __construct()
    {
        $this->head_student = new ArrayCollection();
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
        $this->level = $section;

        return $this;
    }

    public function getStudentsNbr(): ?int
    {
        return $this->students_nbr;
    }

    public function setStudentsNbr(int $students_nbr): static
    {
        $this->students_nbr = $students_nbr;

        return $this;
    }

    /**
     * @return Collection<int, Students>
     */
    public function getHeadStudent(): Collection
    {
        return $this->head_student;
    }

    public function addHeadStudent(Students $headStudent): static
    {
        if (!$this->head_student->contains($headStudent)) {
            $this->head_student->add($headStudent);
            $headStudent->setClassId($this);
        }

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

}
