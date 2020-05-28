<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RateReview
 *
 * @ORM\Table(name="rate_review", indexes={@ORM\Index(name="rate_id", columns={"rate_id"})})
 * @ORM\Entity
 */
class RateReview
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=512, nullable=false)
     */
    private $email;

    /**
     * @var int
     *
     * @ORM\Column(name="note", type="integer", nullable=false)
     */
    private $note;

    /**
     * @var string
     *
     * @ORM\Column(name="review", type="string", length=1024, nullable=false)
     */
    private $review;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="publish_date", type="date", nullable=false)
     */
    private $publishDate;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="publish", type="boolean", nullable=true)
     */
    private $publish;

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

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(int $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getReview(): ?string
    {
        return $this->review;
    }

    public function setReview(string $review): self
    {
        $this->review = $review;

        return $this;
    }

    public function getPublishDate(): ?\DateTimeInterface
    {
        return $this->publishDate;
    }

    public function setPublishDate(\DateTimeInterface $publishDate): self
    {
        $this->publishDate = $publishDate;

        return $this;
    }

    public function getPublish(): ?bool
    {
        return $this->publish;
    }

    public function setPublish(?bool $publish): self
    {
        $this->publish = $publish;

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
