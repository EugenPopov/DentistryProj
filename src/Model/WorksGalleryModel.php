<?php


namespace App\Model;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

class WorksGalleryModel implements ModelInterface
{
    /**
     * @Assert\Image()
     */
    private $image;

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