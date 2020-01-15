<?php


namespace App\Model;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

class BlogModel implements ModelInterface
{
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
    /**
     * @Assert\Image()
     */
    private $image;
    private $seo_title;
    private $seo_description;

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     * @return BlogModel
     */
    public function setTitle($title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     * @return BlogModel
     */
    public function setDescription($description): self
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
     * @return BlogModel
     */
    public function setShortDescription(?string $short_description): self
    {
        $this->short_description = $short_description;

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
     * @return BlogModel
     */
    public function setImage(?UploadedFile $image): self
    {
        $this->image = $image;

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
     * @return BlogModel
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
     * @return BlogModel
     */
    public function setSeoDescription($seo_description): self
    {
        $this->seo_description = $seo_description;

        return $this;
    }


}