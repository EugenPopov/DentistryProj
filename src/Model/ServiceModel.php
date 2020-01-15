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
    /**
     * @Assert\NotBlank()
     */
    private $short_description;
    private $additional_info;
    private $mini_services;
    private $seo_title;
    private $seo_description;

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
    public function setTitle(?string $title): self
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
    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getShortDescription(): ?string
    {
        return $this->short_description;
    }

    /**
     * @param mixed $short_description
     * @return ServiceModel
     */
    public function setShortDescription(?string $short_description): self
    {
        $this->short_description = $short_description;

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
    public function getMiniServices()
    {
        return $this->mini_services;
    }

    /**
     * @param mixed $mini_services
     * @return ServiceModel
     */
    public function setMiniServices($mini_services): self
    {
        $this->mini_services = $mini_services;

        return $this;
    }
    /**
     * @return mixed
     */
    public function getSeoTitle()
    {
        return $this->seo_title;
    }

    /**
     * @param mixed $seo_title
     * @return DoctorModel
     */
    public function setSeoTitle($seo_title): self
    {
        $this->seo_title = $seo_title;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSeoDescription()
    {
        return $this->seo_description;
    }

    /**
     * @param mixed $seo_description
     * @return DoctorModel
     */
    public function setSeoDescription($seo_description): self
    {
        $this->seo_description = $seo_description;

        return $this;
    }

}