<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Rate
 *
 * @ORM\Table(name="rate", indexes={@ORM\Index(name="user_id", columns={"user_id"})})
 * @ORM\Entity
 */
class Rate
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
     * @ORM\Column(name="slug", type="string", length=312, nullable=false)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=512, nullable=false)
     */
    private $description;

    /**
     * @var string|null
     *
     * @ORM\Column(name="url", type="string", length=356, nullable=true)
     */
    private $url;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user_id;

    /**
     * @ORM\OneToMany(targetEntity=RateAccess::class, mappedBy="rate_id", orphanRemoval=true)
     */
    private $rate_access;

    /**
     * @ORM\OneToMany(targetEntity=RateReview::class, mappedBy="rate_id", orphanRemoval=true)
     */
    private $rate_reviews;

    public function __construct()
    {
        $this->rate_access = new ArrayCollection();
        $this->rate_reviews = new ArrayCollection();
    }


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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * @return Collection|RateAccess[]
     */
    public function getRateAccess(): Collection
    {
        return $this->rate_access;
    }

    public function addRateAccess(RateAccess $rateAccess): self
    {
        if (!$this->rate_access->contains($rateAccess)) {
            $this->rate_access[] = $rateAccess;
            $rateAccess->setRateId($this);
        }

        return $this;
    }

    public function removeRateAccess(RateAccess $rateAccess): self
    {
        if ($this->rate_access->contains($rateAccess)) {
            $this->rate_access->removeElement($rateAccess);
            // set the owning side to null (unless already changed)
            if ($rateAccess->getRateId() === $this) {
                $rateAccess->setRateId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|RateReview[]
     */
    public function getRateReviews(): Collection
    {
        return $this->rate_reviews;
    }

    public function addRateReview(RateReview $rateReview): self
    {
        if (!$this->rate_reviews->contains($rateReview)) {
            $this->rate_reviews[] = $rateReview;
            $rateReview->setRateId($this);
        }

        return $this;
    }

    public function removeRateReview(RateReview $rateReview): self
    {
        if ($this->rate_reviews->contains($rateReview)) {
            $this->rate_reviews->removeElement($rateReview);
            // set the owning side to null (unless already changed)
            if ($rateReview->getRateId() === $this) {
                $rateReview->setRateId(null);
            }
        }

        return $this;
    }

    public function __toString() : string
    {
        return strval($this->getId());
    }
}
