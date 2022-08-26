<?php

namespace GeekBrains\LevelTwo\Blog;

class Post
{
    private UUID $id;
    private User $user;
    private string $title;
    private string $text;

    public function __construct(
        UUID $id,
        User $user,
        string $title,
        string $text,
    )
    {
        $this->id = $id;
        $this->text = $text;
        $this->title = $title;
        $this->user = $user;
    }

    /**
     * @return UUID
     */
    public function id(): UUID
    {
        return $this->id;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText(string $text): Post
    {
        $this->text = $text;
        return $this;
    }

    public function __toString()
    {
        return $this->user . ' пишет: ' . $this->text  . PHP_EOL;
    }
}