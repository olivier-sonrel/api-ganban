<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\RoleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoleRepository::class)]
#[ApiResource]
class Role
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'role', targetEntity: UserToSprint::class)]
    private Collection $userToSprint;

    #[ORM\OneToMany(mappedBy: 'role', targetEntity: UserToProject::class)]
    private Collection $userToProject;

    public function __construct()
    {
        $this->userToSprint = new ArrayCollection();
        $this->userToProject = new ArrayCollection();
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

    /**
     * @return Collection<int, UserToSprint>
     */
    public function getUserToSprint(): Collection
    {
        return $this->userToSprint;
    }

    public function addUserToSprint(UserToSprint $userToSprint): self
    {
        if (!$this->userToSprint->contains($userToSprint)) {
            $this->userToSprint->add($userToSprint);
            $userToSprint->setRole($this);
        }

        return $this;
    }

    public function removeUserToSprint(UserToSprint $userToSprint): self
    {
        if ($this->userToSprint->removeElement($userToSprint)) {
            // set the owning side to null (unless already changed)
            if ($userToSprint->getRole() === $this) {
                $userToSprint->setRole(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, UserToProject>
     */
    public function getUserToProject(): Collection
    {
        return $this->userToProject;
    }

    public function addUserToProject(UserToProject $userToProject): self
    {
        if (!$this->userToProject->contains($userToProject)) {
            $this->userToProject->add($userToProject);
            $userToProject->setRole($this);
        }

        return $this;
    }

    public function removeUserToProject(UserToProject $userToProject): self
    {
        if ($this->userToProject->removeElement($userToProject)) {
            // set the owning side to null (unless already changed)
            if ($userToProject->getRole() === $this) {
                $userToProject->setRole(null);
            }
        }

        return $this;
    }
}
