<?php

namespace App\Entity;

use App\Repository\CoursClassesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CoursClassesRepository::class)]
class CoursClasses
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, Cours>
     */
    #[ORM\ManyToMany(targetEntity: Cours::class)]
    private Collection $cours_id;

    /**
     * @var Collection<int, Classes>
     */
    #[ORM\ManyToMany(targetEntity: Classes::class)]
    private Collection $class_id;

    public function __construct()
    {
        $this->cours_id = new ArrayCollection();
        $this->class_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Cours>
     */
    public function getCoursId(): Collection
    {
        return $this->cours_id;
    }

    public function addCoursId(Cours $coursId): static
    {
        if (!$this->cours_id->contains($coursId)) {
            $this->cours_id->add($coursId);
        }

        return $this;
    }

    public function removeCoursId(Cours $coursId): static
    {
        $this->cours_id->removeElement($coursId);

        return $this;
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
}
