<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PictureRepository")
 */
class Picture
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var Partner
     *
     * @ORM\ManyToOne(targetEntity="Partner")
     * @ORM\JoinColumn(name="fk_partner_id", referencedColumnName="id")
     */
    private $partner;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    public function getId()
    {
        return $this->id;
    }

    public function getPartner(): ?Partner
    {
        return $this->partner;
    }

    public function setPartner(Partner $partner): self
    {
        $this->partner = $partner;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }
}
