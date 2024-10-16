<?php

namespace App\Entity;

use App\Repository\CoursClassesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CoursClassesRepository::class)]
#[ORM\Table(name: 'cours_classes')]
class CoursClasses
{
    #[ORM\ManyToOne(targetEntity: Cours::class)]
    #[ORM\JoinColumn(name: 'cours_id', referencedColumnName: 'id', nullable: false)]
    #[ORM\Id] // cours_id fait partie de la clé primaire composite
    private ?Cours $cours = null;

    #[ORM\ManyToOne(targetEntity: Classes::class)]
    #[ORM\JoinColumn(name: 'classe_id', referencedColumnName: 'id', nullable: false)]
    #[ORM\Id] // classe_id fait partie de la clé primaire composite
    private ?Classes $classe = null;

    public function getCours(): ?Cours
    {
        return $this->cours;
    }

    public function setCours(?Cours $cours): self
    {
        $this->cours = $cours;

        return $this;
    }

    public function getClasse(): ?Classes
    {
        return $this->classe;
    }

    public function setClasse(?Classes $classe): self
    {
        $this->classe = $classe;

        return $this;
    }
}