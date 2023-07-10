<?php

namespace App\Entity;

use DateTime;


class Odre
{


    public function __construct(
        private DateTime $createdAt,
        private string $customName,
        private int $id_monture,
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

    /**
     * @return int
     */
    public function getId_monture(): int
    {
        return $this->id_monture;
    }

    /**
     * @param int $id_monture 
     * @return self
     */
    public function setId_monture(int $id_monture): self
    {
        $this->id_monture = $id_monture;
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