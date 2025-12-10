<?php

namespace App\Entity;

use DateTime;
use Symfony\Component\Validator\Constraints as Assert;

class Post
{
    private int $id;

    #[Assert\NotBlank(message: "Le titre de l'article ne doit pas être vide !")]
    #[Assert\Length(
        min: 10,
        max: 150,
        minMessage: "Le titre de l'article doit faire plus de 10 caractères.",
        maxMessage: "Le titre de l'article doit faire moins de 150 caractères."
    )]
    private string $title;

    #[Assert\NotBlank(message: "Le contenu de l'article ne doit pas être vide !")]
    #[Assert\Length(
        min: 10,
        max: 150,
        minMessage: "Le contenu de l'article doit faire plus de 10 caractères.",
        maxMessage: "Le contenu de l'article doit faire moins de 150 caractères."
    )]
    private string $content;
    private string $image;
    private DateTime $publishedAt;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $newId): self
    {
        $this->id = $newId;
        return $this;
    }

    /**
     * Get the value of title
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Set the value of title
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of content
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * Set the value of content
     */
    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the value of image
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * Set the value of image
     */
    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get the value of publishedAt
     */
    public function getPublishedAt(): DateTime
    {
        return $this->publishedAt;
    }

    /**
     * Set the value of publishedAt
     */
    public function setPublishedAt(DateTime $publishedAt): self
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }
}
