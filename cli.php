<?php

use GeekBrains\LevelTwo\Blog\Command\Arguments;
use GeekBrains\LevelTwo\Blog\Command\CreateUserCommand;
use GeekBrains\LevelTwo\Blog\Repositories\CommentsRepository\SqliteCommentsRepository;
use GeekBrains\LevelTwo\Blog\Repositories\PostsRepository\SqlitePostsRepository;
use GeekBrains\LevelTwo\Blog\Repositories\UsersRepository\SqliteUsersRepository;
use GeekBrains\LevelTwo\Blog\Post;
use GeekBrains\LevelTwo\Blog\UUID;
use GeekBrains\LevelTwo\Blog\Comment;

include __DIR__ . "/vendor/autoload.php";

//Создаём объект подключения к SQLite
$connection = new PDO('sqlite:' . __DIR__ . '/blog.sqlite');

// получаем пользователя для написания поста
$usersRepository = new SqliteUsersRepository($connection);
$user = $usersRepository->getByUsername('user');

// создаём пост полученного пользователя
$faker = Faker\Factory::create('ru_RU');
$title = $faker->realText(round(30, 50));
$text = $faker->realText(round(120, 150));

$post = new Post(UUID::random(), $user, $title, $text);
$postsRepository = new SqlitePostsRepository($connection);

$postsRepository->save($post);

// получаем пост по uuid поста
$post = $postsRepository->get(new UUID('e7a19712-ec7b-4f6f-9a1c-ae56e5797972'));
echo $post;

// создаём comment
$comment = new Comment(UUID::random(), $user, $post, $faker->realText(round(100, 130)));
$commentRepository = new SqliteCommentsRepository($connection);

$commentRepository->save($comment);

$comment = $commentRepository->get(new UUID('720f8ec0-8dc1-40da-b730-d1944fb03a09'));
echo $comment;

//$command = new CreateUserCommand($usersRepository);
//
//try {
//    $command->handle(Arguments::fromArgv($argv));
//} catch (Exception $e) {
//    echo $e->getMessage();
//}
