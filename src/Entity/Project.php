<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Blameable\Traits\BlameableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
#[ApiResource]
class Project
{
    /**
     * Hook blameable behavior
     * updates createdBy, updatedBy fields
     */
    use BlameableEntity;
    use TimestampableEntity;


    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    /** All the sprints, it generated the ligne in the kanban later */
    #[ORM\OneToMany(mappedBy: 'project', targetEntity: Sprint::class)]
    private Collection $sprints;

    #[ORM\OneToMany(mappedBy: 'project', targetEntity: UserToProject::class, orphanRemoval: true)]
    private Collection $usersRoles;

    public function __construct()
    {
        $this->sprintsRoles = new ArrayCollection();
        $this->usersRoles = new ArrayCollection();
        $this->sprints = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Sprint>
     */
    public function getSprints(): Collection
    {
        return $this->sprints;
    }

    public function addSprint(Sprint $sprint): self
    {
        if (!$this->sprints->contains($sprint)) {
            $this->sprints->add($sprint);
            $sprint->setProject($this);
        }

        return $this;
    }

    public function removeSprint(Sprint $sprint): self
    {
        if ($this->sprints->removeElement($sprint)) {
            // set the owning side to null (unless already changed)
            if ($sprint->getProject() === $this) {
                $sprint->setProject(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, UserToProject>
     */
    public function getUsersRoles(): Collection
    {
        return $this->usersRoles;
    }

    public function addUsersRole(UserToProject $usersRole): self
    {
        if (!$this->usersRoles->contains($usersRole)) {
            $this->usersRoles->add($usersRole);
            $usersRole->setProject($this);
        }

        return $this;
    }

    public function removeUsersRole(UserToProject $usersRole): self
    {
        if ($this->usersRoles->removeElement($usersRole)) {
            // set the owning side to null (unless already changed)
            if ($usersRole->getProject() === $this) {
                $usersRole->setProject(null);
            }
        }

        return $this;
    }
}
