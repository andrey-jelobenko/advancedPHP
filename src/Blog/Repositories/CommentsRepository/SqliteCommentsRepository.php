<?php

namespace GeekBrains\LevelTwo\Blog\Repositories\CommentsRepository;

use GeekBrains\LevelTwo\Blog\Exceptions\InvalidArgumentException;
use GeekBrains\LevelTwo\Blog\Exceptions\UserNotFoundException;
use GeekBrains\LevelTwo\Blog\Post;
use GeekBrains\LevelTwo\Blog\Comment;
use GeekBrains\LevelTwo\Blog\Repositories\PostsRepository\SqlitePostsRepository;
use GeekBrains\LevelTwo\Blog\Repositories\UsersRepository\SqliteUsersRepository;
use GeekBrains\LevelTwo\Blog\User;
use GeekBrains\LevelTwo\Blog\UUID;
use PDO;
use PDOStatement;

class SqliteCommentsRepository implements CommentsRepositoryInterface
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(Comment $comment): void
    {
        // Подготавливаем запрос
        $statement = $this->connection->prepare(
            'INSERT INTO comments (uuid, post_uuid, author_uuid, text) VALUES (:uuid, :post_uuid, :author_uuid, :text)'
        );
        // Выполняем запрос с конкретными значениями
        $statement->execute([
            ':uuid' => (string)$comment->id(),
            ':post_uuid' => $comment->getPost()->id(),
            ':author_uuid' => $comment->getUser()->uuid(),
            ':text' => $comment->getText(),
        ]);
    }

    public function get(UUID $uuid): Comment
    {
        $statement = $this->connection->prepare(
            'SELECT * FROM comments WHERE uuid = ?'
        );

        $statement->execute([(string)$uuid]);

        return $this->getComment($statement);
    }

    private function getComment(PDOStatement $statement): Comment
    {
        $result = $statement->fetch(\PDO::FETCH_ASSOC);

//      не решил как получить User'а и Post, но так мне кажется как-то не правильно

        $postsRepository = new SqlitePostsRepository($this->connection);
        $post = $postsRepository->get(new UUID($result['post_uuid']));

        $usersRepository = new SqliteUsersRepository($this->connection);
        $user = $usersRepository->get(new UUID($result['author_uuid']));

        // Создаём объект поста по данным запроса
        return new Comment(
            new UUID($result['uuid']),
            $user,
            $post,
            $result['text'],
        );
    }

}