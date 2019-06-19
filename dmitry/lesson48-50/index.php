<?php

/**
LESSON 50 
Задача 2:

Пусть на нашем сайте, кроме страницы login.php, есть еще и страница index.php. Сделайте так, чтобы часть страницы index.php была открыта для всех пользователей, а часть - только для авторизованных.

Задача 3:

Модифицируйте ваш код так, чтобы при успешной авторизации в сессию записывался также логин пользователя.

Сделайте так, чтобы при заходе на любую страницу сайта, авторизованный пользователь видел сообщение "Вы зашли как user" (вместо user, конечно же, тот логин, под которым зашел пользователь), а не авторизованный - сообщение "Пожалуйста, авторизуйтесь" и ссылку на страницу авторизации.

*/
session_start();
include __DIR__ . '/elems/init.php';

$table_name = 'pages';
$host = 'localhost'; //имя хоста, на локальном компьютере это localhost
$user = 'root'; //имя пользователя, по умолчанию это root
$password = ''; //пароль, по умолчанию пустой
$db_name = '48-55'; //имя базы данных

$link = mysqli_connect($host, $user, $password, $db_name);

if ( isset($_SESSION['auth']) and ($_SESSION['auth'] === true) )
{
    $message = $_SESSION['message']['text'] . ' как ' . $_SESSION['login'];
}
else if ( isset($_SESSION['auth']) and ($_SESSION['auth'] === false) )
{
    $message = $_SESSION['login'] . ', вы не авторизованы. ';
}

if ( isset($_GET['page']) )
{
    $page = $_GET['page'];

    $query = 'SELECT * FROM ' . $table_name . ' WHERE url = \'' . $page . '\'';
    $result = mysqli_query($link, $query) or die( mysqli_error($link) );
    $page = mysqli_fetch_assoc($result);

    $file = 'pages/' . $page . '.php';
    if ( NULL === $page ) {
        $query = 'SELECT * FROM ' . $table_name . ' WHERE url = \'404\'';
        $result = mysqli_query($link, $query) or die( mysqli_error($link) );
        $page = mysqli_fetch_assoc($result);

        header("HTTP/1.0 404 Not Found");
    }



    $content = $content . ' ' . $page['text'];
    $title = $page['title'];
}
else
{
    $query = 'SELECT id, url, title FROM ' . $table_name . ' WHERE url != \'404\' ORDER BY id DESC';
    $result = mysqli_query($link, $query) or die( mysqli_error($link) );
    for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);

    $content = $message;

    // Список статей скрыт от неавторизованных пользователей.
    if ( isset($_SESSION['auth']) and ($_SESSION['auth'] === true) )
    {
        $content = $content . '<h3> Статьи сайта, отсортированные по убыванию даты добавления </h3>';

        foreach ($data as $page) {
            if ($page['url'] != '/') {
                $href_part  = '/?page=';
            } else {
                $href_part = '';
            }

           $content = $content . '<p><a href="' . $href_part . $page['url'] . '">' . $page['title'] . '</a></p>';
        }
    }
    else
    {
        $content = $content . 'Для получения списка статей, пожалуйста, <a href="/dmitry/lesson48-50/login.php">авторизуйтесь</a>';
    }

}



include 'layout.php';



