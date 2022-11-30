<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\SprintRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SprintRepository::class)]
#[ApiResource]
class Sprint
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'sprints')]
    private ?Project $project = null;

    #[ORM\OneToMany(mappedBy: 'sprint', targetEntity: Column::class)]
    private Collection $columns;

    #[ORM\OneToMany(mappedBy: 'sprint', targetEntity: UserToSprint::class, orphanRemoval: true)]
    private Collection $usersRoles;

    public function __construct()
    {
        $this->columns = new ArrayCollection();
        $this->users = new ArrayCollection();
        $this->usersRoles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function setProject(?Project $project): self
    {
        $this->project = $project;

        return $this;
    }

    /**
     * @return Collection<int, Column>
     */
    public function getColumns(): Collection
    {
        return $this->columns;
    }

    public function addColumn(Column $column): self
    {
        if (!$this->columns->contains($column)) {
            $this->columns->add($column);
            $column->setSprint($this);
        }

        return $this;
    }

    public function removeColumn(Column $column): self
    {
        if ($this->columns->removeElement($column)) {
            // set the owning side to null (unless already changed)
            if ($column->getSprint() === $this) {
                $column->setSprint(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, UserToSprint>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    /**
     * @return Collection<int, UserToSprint>
     */
    public function getUsersRoles(): Collection
    {
        return $this->usersRoles;
    }

    public function addUsersRole(UserToSprint $usersRole): self
    {
        if (!$this->usersRoles->contains($usersRole)) {
            $this->usersRoles->add($usersRole);
            $usersRole->setSprint($this);
        }

        return $this;
    }

    public function removeUsersRole(UserToSprint $usersRole): self
    {
        if ($this->usersRoles->removeElement($usersRole)) {
            // set the owning side to null (unless already changed)
            if ($usersRole->getSprint() === $this) {
                $usersRole->setSprint(null);
            }
        }

        return $this;
    }
}
