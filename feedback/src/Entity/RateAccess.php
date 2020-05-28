<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RateAccess
 *
 * @ORM\Table(name="rate_access", indexes={@ORM\Index(name="rate_id", columns={"rate_id"})})
 * @ORM\Entity
 */
class RateAccess
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="_uniq", type="integer", nullable=false)
     */
    private $uniq;

    /**
     * @var bool
     *
     * @ORM\Column(name="open", type="boolean", nullable=false, options={"default"="1"})
     */
    private $open = true;

    /**
     * @var \Rate
     *
     * @ORM\ManyToOne(targetEntity="Rate")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="rate_id", referencedColumnName="id")
     * })
     */
    private $rate_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUniq(): ?int
    {
        return $this->uniq;
    }

    public function setUniq(int $uniq): self
    {
        $this->uniq = $uniq;

        return $this;
    }

    public function getOpen(): ?bool
    {
        return $this->open;
    }

    public function setOpen(bool $open): self
    {
        $this->open = $open;

        return $this;
    }

    public function getRateId(): ?Rate
    {
        return $this->rate_id;
    }

    public function setRateId(?Rate $rate_id): self
    {
        $this->rate_id = $rate_id;

        return $this;
    }
}
