<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HotWordRepository")
 */
class HotWord
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Partner", inversedBy="hotWords")
     * @ORM\JoinColumn(nullable=true, name = "fk_partner_id")
     */
    private $partner;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     */
    private $name;

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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
