<?php

namespace App\Entity;

use DateTime;


class Ordre
{

    /**
     * Summary of __construct
     * @param \DateTime $createdAt
     * @param string $customName
     * @param int $idmonture
     * @param mixed $id
     */
    public function __construct(
        private DateTime $createdAt,
        private string $customName,
        private int $idMonture,
        private ?int $id = null
    ) {
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $createdAt 
     * @return self
     */
    public function setCreatedAt(DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return string
     */
    public function getCustomName(): string
    {
        return $this->customName;
    }

    /**
     * @param string $customName 
     * @return self
     */
    public function setCustomName(string $customName): self
    {
        $this->customName = $customName;
        return $this;
    }
    public function getIdMonture(): int
    {
        return $this->idMonture;
    }

    /**
     * @param int $idMonture 
     * @return self
     */
    public function setIdMonture(int $idMonture): self
    {
        $this->idMonture = $idMonture;
        return $this;
    }


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

    /**
     * @return int
     */


}