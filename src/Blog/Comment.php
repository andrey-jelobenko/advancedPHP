<?php

namespace GeekBrains\LevelTwo\Blog;

class Comment
{
    private int $id;
    private User $author;
    private Post $post;
    private string $text;

    /**
     * @param int $id
     * @param User $author
     * @param Post $post
     * @param string $text
     */
    public function __construct(int $id, User $author, Post $post, string $text)
    {
        $this->id = $id;
        $this->author = $author;
        $this->post = $post;
        $this->text = $text;
    }

    function __toString(): string
    {
        return $this->author->getUsername() . ' на тему поста с id ' . $this->post->getId() . ' автора ' . $this->post->getAuthor() . ' пишет: ' . $this->getText();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getAuthorId(): int
    {
        return $this->author->id();
    }

    /**
     * @param User $author
     */
    public function setAuthor(User $author): void
    {
        $this->author = $author;
    }

    /**
     * @return int
     */
    public function getPostId(): int
    {
        return $this->post->getId();
    }

    /**
     * @param Post $post
     */
    public function setPost(Post $post): void
    {
        $this->post = $post;
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
    public function setText(string $text): void
    {
        $this->text = $text;
    }

}