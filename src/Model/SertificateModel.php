<?php


namespace App\Model;


use App\Entity\Doctor;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class SertificateModel implements ModelInterface
{
    private $title;
    private $doctor;
    private $image;

    /**
     * @return mixed
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     * @return SertificateModel
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDoctor(): ?Doctor
    {
        return $this->doctor;
    }

    /**
     * @param mixed $doctor
     * @return SertificateModel
     */
    public function setDoctor(?Doctor $doctor): self
    {
        $this->doctor = $doctor;

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
     */
    public function setImage(?UploadedFile $image): void
    {
        $this->image = $image;
    }
}