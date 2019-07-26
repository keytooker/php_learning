<?php
$host = 'localhost'; //имя хоста, на локальном компьютере это localhost
$user = 'root'; //имя пользователя, по умолчанию это root
$password = ''; //пароль, по умолчанию пустой
$db_name = '48-55'; //имя базы данных

$link = mysqli_connect($host, $user, $password, $db_name);

//Устанавливаем кодировку (не обязательно, но поможет избежать проблем):
mysqli_query($link, "SET NAMES 'utf8'");

//Формируем тестовый запрос:
$query = 'SELECT * FROM users';

//Делаем запрос к БД, результат запроса пишем в $result:
$result = mysqli_query($link, $query) or die(mysqli_error($link));

/**
 * Урок 54
 * Задача 3
 * Сделайте страницу users.php, зайдя на которую любой пользователь нашего сайта может увидеть список всех
 * зарегистрированных пользователей нашего сайта в виде ссылок. Каждая ссылка будет вести на соответствующий профиль.
 */
//Преобразуем то, что отдала нам база в нормальный массив PHP $data:
for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);

?>
    <p>
        Пользователи:
    </p>
<?php

foreach ($data as $user)
{
    ?>
    <p>
        <a href="/dmitry/lesson48-54/profile.php?id=<?=  $user['id']; ?>">Пользователь # <?=  $user['id']; ?></a>

    </p>
<?php
}
?>