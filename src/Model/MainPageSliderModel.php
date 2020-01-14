<?php


namespace App\Model;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

class MainPageSliderModel implements ModelInterface
{
    /**
     * @Assert\Image()
     */
    private $image;

    private $link;

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

    /**
     * @return mixed
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param mixed $link
     * @return MainPageSliderModel
     */
    public function setLink($link): self
    {
        $this->link = $link;

        return $this;
    }




}