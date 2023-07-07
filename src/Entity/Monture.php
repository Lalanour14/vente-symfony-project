<?php

namespace App\Entity;


class Monture
{


    public function __construct(
        private string $marque,
        private string $model,
        private float $basePrice,
        private string $picture,
        private ?int $id = null
    ) {

    }

    /**
     * @return string
     */
    public function getMarque(): string
    {
        return $this->marque;
    }

    /**
     * @param string $marque 
     * @return self
     */
    public function setMarque(string $marque): self
    {
        $this->marque = $marque;
        return $this;
    }

    /**
     * @return string
     */
    public function getModel(): string
    {
        return $this->model;
    }

    /**
     * @param string $model 
     * @return self
     */
    public function setModel(string $model): self
    {
        $this->model = $model;
        return $this;
    }

    /**
     * @return float
     */
    public function getBasePrice(): float
    {
        return $this->basePrice;
    }

    /**
     * @param float $basePrice 
     * @return self
     */
    public function setBasePrice(float $basePrice): self
    {
        $this->basePrice = $basePrice;
        return $this;
    }

    /**
     * @return string
     */
    public function getPicture(): string
    {
        return $this->picture;
    }

    /**
     * @param string $picture 
     * @return self
     */
    public function setPicture(string $picture): self
    {
        $this->picture = $picture;
        return $this;
    }

    /**
     * @return 
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param  $id 
     * @return self
     */
    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
    }

}