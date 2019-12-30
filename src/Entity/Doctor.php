<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DoctorRepository")
 */
class Doctor implements EntityInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $speciality;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $university;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $experience;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Service", mappedBy="doctor")
     */
    private $services;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Sertificate", mappedBy="doctor")
     */
    private $sertificates;

    /**
     * @ORM\Column(type="integer")
     */
    private $queue;

    public function __construct()
    {
        $this->services = new ArrayCollection();
        $this->sertificates = new ArrayCollection();
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

    public function getSlug()
    {
        return $this->slug;
    }

    public function getSpeciality(): ?string
    {
        return $this->speciality;
    }

    public function setSpeciality(string $speciality): self
    {
        $this->speciality = $speciality;

        return $this;
    }

    public function getUniversity(): ?string
    {
        return $this->university;
    }

    public function setUniversity(?string $university): self
    {
        $this->university = $university;

        return $this;
    }

    public function getExperience(): ?string
    {
        return $this->experience;
    }

    public function setExperience(?string $experience): self
    {
        $this->experience = $experience;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection|Service[]
     */
    public function getServices(): Collection
    {
        return $this->services;
    }

    public function addService(Service $service): self
    {
        if (!$this->services->contains($service)) {
            $this->services[] = $service;
            $service->addDoctor($this);
        }

        return $this;
    }

    public function removeService(Service $service): self
    {
        if ($this->services->contains($service)) {
            $this->services->removeElement($service);
            $service->removeDoctor($this);
        }

        return $this;
    }

    /**
     * @return Collection|Sertificate[]
     */
    public function getSertificates(): Collection
    {
        return $this->sertificates;
    }

    public function addSertificate(Sertificate $sertificate): self
    {
        if (!$this->sertificates->contains($sertificate)) {
            $this->sertificates[] = $sertificate;
            $sertificate->setDoctor($this);
        }

        return $this;
    }

    public function removeSertificate(Sertificate $sertificate): self
    {
        if ($this->sertificates->contains($sertificate)) {
            $this->sertificates->removeElement($sertificate);
            // set the owning side to null (unless already changed)
            if ($sertificate->getDoctor() === $this) {
                $sertificate->setDoctor(null);
            }
        }

        return $this;
    }

    public function getQueue(): ?int
    {
        return $this->queue;
    }

    public function setQueue(int $queue): self
    {
        $this->queue = $queue;

        return $this;
    }
}
