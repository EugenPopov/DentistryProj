<?php


namespace App\Model;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;


class MainPageSliderModel implements ModelInterface
{
    private $bold_title;
    /**
     * @Assert\NotBlank()
     */
    private $title;

    /**
     * @Assert\NotBlank()
     */
    private $description;
    /**
     * @Assert\Image()
     */
    private $image;

    /**
     * @return mixed
     */
    public function getBoldTitle(): ?string
    {
        return $this->bold_title;
    }

    /**
     * @param mixed $bold_title
     * @return MainPageSliderModel
     */
    public function setBoldTitle(?string $bold_title): self
    {
        $this->bold_title = $bold_title;

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
     * @return MainPageSliderModel
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
     * @return MainPageSliderModel
     */
    public function setDescription(?string $description): self
    {
        $this->description = $description;

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
     * @return MainPageSliderModel
     */
    public function setImage(?UploadedFile $image): self
    {
        $this->image = $image;

        return $this;
    }


}