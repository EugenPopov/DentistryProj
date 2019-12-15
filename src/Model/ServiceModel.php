<?php


namespace App\Model;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;


class ServiceModel implements ModelInterface
{
    /**
     * @Assert\Image()
     */
    private $icon;
    /**
     * @Assert\Image()
     */
    private $image;
    /**
     * @Assert\NotBlank()
     */
    private $title;
    /**
     * @Assert\NotBlank()
     */
    private $description;
    private $additional_info;
    private $doctors;

    /**
     * @return mixed
     */
    public function getIcon(): ?UploadedFile
    {
        return $this->icon;
    }

    /**
     * @param mixed $icon
     * @return ServiceModel
     */
    public function setIcon(?UploadedFile $icon): self
    {
        $this->icon = $icon;

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
     * @return ServiceModel
     */
    public function setImage(?UploadedFile $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     * @return ServiceModel
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     * @return ServiceModel
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAdditionalInfo(): ?string
    {
        return $this->additional_info;
    }

    /**
     * @param mixed $additional_info
     * @return ServiceModel
     */
    public function setAdditionalInfo(?string $additional_info): self
    {
        $this->additional_info = $additional_info;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDoctors()
    {
        return $this->doctors;
    }

    /**
     * @param mixed $doctors
     */
    public function setDoctors($doctors): void
    {
        $this->doctors = $doctors;
    }





}