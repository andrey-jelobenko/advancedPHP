<?php

namespace GeekBrains\LevelTwo\Blog;

use GeekBrains\LevelTwo\Person\Person;

class Post
{
    private int $id;
    private User $author;
    private string $title;
    private string $text;

    /**
     * @param int $id
     * @param User $author
     * @param string $title
     * @param string $text
     */
    public function __construct(int $id, User $author, string $title, string $text)
    {
        $this->id = $id;
        $this->author = $author;
        $this->title = $title;
        $this->text = $text;
    }

    public function __toString()
    {
        return $this->author->getUsername() . ' на тему "' . $this->title . '" пишет: ' . $this->text  . PHP_EOL;
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
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return User
     */
    public function getAuthor(): User
    {
        return $this->author;
    }

}