<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\PartnerRepository")
 */
class Partner
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank()
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=500)
     * @Assert\NotBlank()
     */
    private $address;

    /**
     * @ORM\Column(name="picture_server_address",type="string", length=200)
     */
    private $picture;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank()
     */
    private $latitude;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank()
     */
    private $longitude;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     */
    private $horary;

    /**
     * @ORM\Column(type="string", length=500)
     * @Assert\NotBlank()
     */
    private $comment;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isSpecialOffer;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $offer;

    /**
     * @var Location
     *
     * @ORM\ManyToOne(targetEntity="Location")
     * @ORM\JoinColumn(name="fk_location_id", referencedColumnName="id")
     */
    private $location;

    /**
     * @ORM\Column(name="trip_advisor_link",type="string", length=500)
     * @Assert\NotBlank()
     */
    private $tripAdvisorLink;

    /**
     * @var PartnerType
     *
     * @ORM\ManyToOne(targetEntity="PartnerType")
     * @ORM\JoinColumn(name="fk_type_id", referencedColumnName="id")
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank()
     */
    private $country;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\HotWord", mappedBy="partner")
     */
    private $hotWords;

    /**
     * Partner constructor.
     */
    public function __construct()
    {
        $this->hotWords = new ArrayCollection();
    }


    public function getId()
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

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

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getHorary(): ?string
    {
        return $this->horary;
    }

    public function setHorary(string $horary): self
    {
        $this->horary = $horary;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getIsSpecialOffer(): ?bool
    {
        return $this->isSpecialOffer;
    }

    public function setIsSpecialOffer(bool $isSpecialOffer): self
    {
        $this->isSpecialOffer = $isSpecialOffer;

        return $this;
    }

    public function getOffer(): ?string
    {
        return $this->offer;
    }

    public function setOffer(string $offer): self
    {
        $this->offer = $offer;

        return $this;
    }

    public function getLocation(): ?Location
    {
        return $this->location;
    }

    public function setLocation(Location $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getTripAdvisorLink(): ?string
    {
        return $this->tripAdvisorLink;
    }

    public function setTripAdvisorLink(?string $tripAdvisorLink): self
    {
        $this->tripAdvisorLink = $tripAdvisorLink;

        return $this;
    }

    public function getType(): ?PartnerType
    {
        return $this->type;
    }

    public function setType(?PartnerType $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }
}
