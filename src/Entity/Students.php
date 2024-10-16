<?php

namespace App\Entity;

use App\Repository\StudentsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StudentsRepository::class)]
class Students
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $firstname = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column(length: 30)]
    private ?string $gender = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $birth_date = null;

    #[ORM\Column(length: 255)]
    private ?string $place_of_birth = null;

    #[ORM\Column(length: 20)]
    private ?string $parent_phone = null;

    #[ORM\Column(length: 255)]
    private ?string $adress = null;
/**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="students")
     * @ORM\JoinColumn(nullable=false)
     */
    private $teacher;
    #[ORM\Column]
    private ?float $generale_average = null;

    #[ORM\ManyToOne(inversedBy: 'head_student')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Classes $class_id = null;

    /**
     * @var Collection<int, EvaluationsStudentsResults>
     */
    #[ORM\OneToMany(targetEntity: EvaluationsStudentsResults::class, mappedBy: 'student_id')]
    private Collection $results_evaluations;

    public function __construct()
    {
        $this->results_evaluations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
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

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): static
    {
        $this->gender = $gender;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birth_date;
    }

    public function setBirthDate(\DateTimeInterface $birth_date): static
    {
        $this->birth_date = $birth_date;

        return $this;
    }

    public function getPlaceOfBirth(): ?string
    {
        return $this->place_of_birth;
    }

    public function setPlaceOfBirth(string $place_of_birth): static
    {
        $this->place_of_birth = $place_of_birth;

        return $this;
    }

    public function getParentPhone(): ?string
    {
        return $this->parent_phone;
    }

    public function setParentPhone(string $parent_phone): static
    {
        $this->parent_phone = $parent_phone;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): static
    {
        $this->adress = $adress;

        return $this;
    }

    public function getGeneraleAverage(): ?float
    {
        return $this->generale_average;
    }

    public function setGeneraleAverage(float $generale_average): static
    {
        $this->generale_average = $generale_average;

        return $this;
    }

    public function getClassId(): ?Classes
    {
        return $this->class_id;
    }

    public function setClassId(?Classes $class_id): static
    {
        $this->class_id = $class_id;

        return $this;
    }

    /**
     * @return Collection<int, EvaluationsStudentsResults>
     */
    public function getResultsEvaluations(): Collection
    {
        return $this->results_evaluations;
    }
    public function getTeacher(): ?User // Ou ?Professor
{
    return $this->teacher;
}

public function setProfessor(?User $teacher): self // Ou ?Professor
{
    $this->teacher = $teacher;

    return $this;
}

    public function addResultsEvaluation(EvaluationsStudentsResults $resultsEvaluation): static
    {
        if (!$this->results_evaluations->contains($resultsEvaluation)) {
            $this->results_evaluations->add($resultsEvaluation);
            $resultsEvaluation->setStudentId($this);
        }

        return $this;
    }

    public function removeResultsEvaluation(EvaluationsStudentsResults $resultsEvaluation): static
    {
        if ($this->results_evaluations->removeElement($resultsEvaluation)) {
            // set the owning side to null (unless already changed)
            if ($resultsEvaluation->getStudentId() === $this) {
                $resultsEvaluation->setStudentId(null);
            }
        }

        return $this;
    }
}
