<?php

namespace App\Entity;

use App\Repository\PlaylistRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlaylistRepository::class)]
class Playlist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, Album>
     */
    #[ORM\ManyToMany(targetEntity: Album::class, inversedBy: 'playlists')]
    private Collection $album;

    #[ORM\ManyToOne(inversedBy: 'playlists')]
    private ?User $userPlaylist = null;

    public function __construct()
    {
        $this->album = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Album>
     */
    public function getAlbum(): Collection
    {
        return $this->album;
    }

    public function addAlbum(Album $album): static
    {
        if (!$this->album->contains($album)) {
            $this->album->add($album);
        }

        return $this;
    }

    public function removeAlbum(Album $album): static
    {
        $this->album->removeElement($album);

        return $this;
    }

    public function getUserPlaylist(): ?User
    {
        return $this->userPlaylist;
    }

    public function setUserPlaylist(?User $userPlaylist): static
    {
        $this->userPlaylist = $userPlaylist;

        return $this;
    }
}
