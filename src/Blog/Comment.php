<?php

namespace GeekBrains\LevelTwo\Blog;

class Comment
{

    public function __construct(
        private UUID $id,
        private User $user,
        private Post $post,
        private string $text
    )
    {
    }

    /**
     * @return int
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
     * @return Post
     */
    public function getPost(): Post
    {
        return $this->post;
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

    public function __toString() {
        return $this->user . " пишет Коммент " . $this->text;
    }

}