<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\SettingsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;

#[ORM\Entity(repositoryClass: SettingsRepository::class)]
class Settings
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\OneToMany(mappedBy: 'settings', targetEntity: Social::class)]
    private Collection $socials;

    #[ORM\Column(type: 'string', length: 255)]
    private string $appName;

    #[ORM\Column(type: 'boolean')]
    private bool $displayAlbums = false;

    #[Pure]
    public function __construct()
    {
        $this->socials = new ArrayCollection();
    }

    public function id(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Social>
     */
    public function socials(): Collection
    {
        return $this->socials;
    }

    public function addSocial(Social $social): self
    {
        if (!$this->socials->contains($social)) {
            $this->socials[] = $social;
            $social->setSettings($this);
        }

        return $this;
    }

    public function removeSocial(Social $social): self
    {
        if ($this->socials->removeElement($social)) {
            // set the owning side to null (unless already changed)
            if ($social->getSettings() === $this) {
                $social->setSettings(null);
            }
        }

        return $this;
    }

    public function appName(): string
    {
        return $this->appName;
    }

    public function setAppName(string $appName): self
    {
        $this->appName = $appName;

        return $this;
    }

    public function isDisplayAlbums(): bool
    {
        return $this->displayAlbums;
    }

    public function setDisplayAlbums(bool $displayAlbums): self
    {
        $this->displayAlbums = $displayAlbums;

        return $this;
    }
}
