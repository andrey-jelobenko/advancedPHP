<?php

use GeekBrains\LevelTwo\Blog\User;
use GeekBrains\LevelTwo\Person\{Name, Person};
use GeekBrains\LevelTwo\Blog\Post;
use GeekBrains\LevelTwo\Blog\Repositories\InMemoryUsersRepository;
use GeekBrains\LevelTwo\Blog\Exceptions\UserNotFoundException;
use \GeekBrains\LevelTwo\Blog\Comment;

/*
 * Задание #1 работает без Faker'а
 *
spl_autoload_register('load');
function load($className)
{
    $file = str_replace('GeekBrains\LevelTwo', 'src', $className) . '.php';
    $file = str_replace('\\', DIRECTORY_SEPARATOR, $file);
    if (file_exists($file)) {
        include $file;
    }
}
*/

include __DIR__ . "/vendor/autoload.php";

//$userRepository = new InMemoryUsersRepository();
//
//try {
//    echo $userRepository->get(1);
//    echo $userRepository->get(2);
//    echo $userRepository->get(3);
//} catch (UserNotFoundException | Exception $e) {
//    echo $e->getMessage();
//}

$faker = Faker\Factory::create('ru_RU');

// автор и его пост, на который будет написан Comment вторым пользователем
$firstNameSrc = $faker->firstName('male');
$lastNameSrc = $faker->lastName('male');
$name = new Name($firstNameSrc, $lastNameSrc);
$userSrc = new User(1, $name, "Admin");
$titleSrc = $faker->realText(round(30, 50));
$textSrc = $faker->realText(round(120, 150));
$postSrc = new Post(1, $userSrc, $titleSrc, $textSrc);

// второй автор, его post и comment на post первого автора
function user($faker): User
{
    $firstName = $faker->firstName('male');
    $lastName = $faker->lastName('male');
    $name = new Name($firstName, $lastName);
    return new User(2, $name, "Admin");
}

function post($faker): Post
{
    $user = user($faker);
    $title = $faker->realText(round(30, 50));
    $text = $faker->realText(round(120, 150));
    return new Post(2, $user, $title, $text);
}

function comment($faker, $postSrc = null): Comment
{
    $user = user($faker);
    $post = $postSrc ?? post($faker);
    $text = $faker->realText(round(80, 100));
    return new Comment(1, $user, $post, $text);;
}

echo match ($argv[1] ?? null) {
    'user' => user($faker),
    'post' => post($faker),
    'comment' => comment($faker, $postSrc),
    default => 'нет нужного параметра',
};
