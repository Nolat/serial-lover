<?php

namespace App\Entity\Trait;

use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

trait EditInfosEntityTrait
{

    #[ORM\ManyToOne(targetEntity: "App\Entity\User")]
    #[Serializer\Groups(['createdBy'])]
    private $createdBy;

    #[ORM\Column(type: 'datetime', nullable: true)]
    #[Serializer\Groups(['timestampable', 'createdAt'])]
    private $createdAt;

    #[ORM\ManyToOne(targetEntity: "App\Entity\User")]
    #[Serializer\Groups(['updatedBy'])]
    private $updatedBy;

    #[ORM\Column(type: 'datetime', nullable: true)]
    #[Serializer\Groups(['timestampable', 'updatedAt'])]
    private $updatedAt;

    #[ORM\ManyToOne(targetEntity: "App\Entity\User")]
    #[Serializer\Groups(['deletedBy'])]
    private $deletedBy;

    #[ORM\Column(type: 'datetime', nullable: true)]
    #[Serializer\Groups(['timestampable', 'deletedAt'])]
    private $deletedAt;

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?User $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedBy(): ?User
    {
        return $this->updatedBy;
    }

    public function setUpdatedBy(?User $updatedBy): self
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getDeletedBy(): ?User
    {
        return $this->deletedBy;
    }

    public function setDeletedBy(?User $deletedBy): self
    {
        $this->deletedBy = $deletedBy;

        return $this;
    }

    public function getDeletedAt(): ?\DateTimeInterface
    {
        return $this->deletedAt;
    }

    public function setDeletedDate(?\DateTimeInterface $deletedAt): self
    {
        if ($deletedAt === null) {
            $deletedDate = 0;
        }
        $this->deletedAt = $deletedAt;

        return $this;
    }
}
