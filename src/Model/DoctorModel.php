<?php


namespace App\Model;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;


class DoctorModel implements ModelInterface
{
    /**
     * @Assert\NotBlank()
     */
    private $name;
    /**
     * @Assert\NotBlank()
     */
    private $speciality;
    private $university;
    private $experience;
    /**
     * @Assert\Image()
     */
    private $image;
    private $services;

    /**
     * @return mixed
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return DoctorModel
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSpeciality(): ?string
    {
        return $this->speciality;
    }

    /**
     * @param mixed $speciality
     * @return DoctorModel
     */
    public function setSpeciality(string $speciality): self
    {
        $this->speciality = $speciality;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUniversity(): ?string
    {
        return $this->university;
    }

    /**
     * @param mixed $university
     * @return DoctorModel
     */
    public function setUniversity(?string $university): self
    {
        $this->university = $university;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getExperience(): ?string
    {
        return $this->experience;
    }

    /**
     * @param mixed $experience
     * @return DoctorModel
     */
    public function setExperience(?string $experience): self
    {
        $this->experience = $experience;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getImage(): ?UploadedFile
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     * @return DoctorModel
     */
    public function setImage(?UploadedFile $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getServices()
    {
        return $this->services;
    }

    /**
     * @param mixed $services
     * @return DoctorModel
     */
    public function setServices($services): self
    {
        $this->services = $services;

        return $this;
    }


}