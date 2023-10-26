<?php

namespace App\Entity;

use App\Repository\CmsPhotoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CmsPhotoRepository::class)
 */
class CmsPhoto
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $titleFR;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $titleDE;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $link;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sitePage;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $heading;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photoOrVideo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getTitleFR(): ?string
    {
        return $this->titleFR;
    }

    public function setTitleFR(?string $titleFR): self
    {
        $this->titleFR = $titleFR;

        return $this;
    }

    public function getTitleDE(): ?string
    {
        return $this->titleDE;
    }

    public function setTitleDE(?string $titleDE): self
    {
        $this->titleDE = $titleDE;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(?string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function getSitePage(): ?string
    {
        return $this->sitePage;
    }

    public function setSitePage(?string $sitePage): self
    {
        $this->sitePage = $sitePage;

        return $this;
    }

    public function getHeading(): ?string
    {
        return $this->heading;
    }

    public function setHeading(?string $heading): self
    {
        $this->heading = $heading;

        return $this;
    }

    public function getPhotoOrVideo(): ?string
    {
        return $this->photoOrVideo;
    }

    public function setPhotoOrVideo(?string $photoOrVideo): self
    {
        $this->photoOrVideo = $photoOrVideo;

        return $this;
    }
}
