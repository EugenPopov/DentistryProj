<?php


namespace App\Model;


class MiniServiceModel implements ModelInterface
{
    private $title;
    private $price;

    /**
     * @return mixed
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     * @return MiniServiceModel
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrice(): ?string
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     * @return MiniServiceModel
     */
    public function setPrice(?string $price): self
    {
        $this->price = $price;

        return $this;
    }


}