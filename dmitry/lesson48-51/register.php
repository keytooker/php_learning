<?php
/**
 * register.php
 *
 * Урок 51 Регистрация
 * Задача 1:

Реализуйте описанную выше регистрацию. После этого зарегистрируйте нового пользователя и авторизуйтесь под ним. Убедитесь, что все работает, как надо.

Задача 2:

Модифицируйте ваш код так, чтобы кроме логина и пароля пользователю нужно было ввести еще и дату своего рождения и email. Сохраните эти данные в базу данных.

 * Задача 3:

Реализуйте описанное добавление даты регистрации пользователя.

 *Задача 4:

Модифицируйте ваш код так, чтобы после регистрации пользователь автоматически становился авторизованным.

 * Задача 5:

Запишите при регистрации в сессию еще и id пользователя.

 * Задача 6:

Модифицируйте ваш код так, чтобы при отправке формы пароль сравнивался с его подтверждением. Если они совпадают - то продолжаем регистрацию, а если не совпадают - то выводим сообщение об этом.

 * Задача 7:

Модифицируйте ваш код так, чтобы при попытке регистрации выполнялась проверка на занятость логина и, если он занят, - выводите сообщение об этом и просите ввести другой логин.

 *
 */



if ( !empty($_POST['login']) and (!empty($_POST['password'])) and !empty($_POST['confirm']) )
{
    if ($_POST['password'] == $_POST['confirm']) {
        $host = 'localhost'; //имя хоста, на локальном компьютере это localhost
        $user = 'root'; //имя пользователя, по умолчанию это root
        $password = ''; //пароль, по умолчанию пустой
        $db_name = '48-55'; //имя базы данных

        //Соединяемся с базой данных используя наши доступы:
        $link = mysqli_connect($host, $user, $password, $db_name);
        mysqli_query($link, "SET NAMES 'utf8'");

        $login = $_POST['login'];
        $password = $_POST['password'];

        // Пробуем получить юзера с таким логином:
        $query = 'SELECT * FROM users WHERE login=\'' . $login . '\'';
        $user = mysqli_fetch_assoc(mysqli_query($link, $query));

        // Если юзера с таким логином нет:
        if (empty($user)) {
            $date = date('Y-m-d', strtotime($_POST['date']));
            $email = $_POST['emailaddress'];

            $registration_date = date('Y-m-d'); // получим текущую дату средствами PHP

            $query = 'INSERT INTO users SET login=\'' . $login . '\', password=\'' . $password . '\', date=\'' . $date .
                '\', email=\'' . $email . '\', registration_date=\'' . $registration_date . '\'';
            mysqli_query($link, $query);

            session_start();
            $_SESSION['auth'] = true;
            $_SESSION['login'] = $login;

            $id = mysqli_insert_id($link);
            $_SESSION['id'] = $id;
        }
        else
        {
            echo 'Пользователь с таким логином уже существует, введите другой';
        }
    }
    else
    {
        echo 'Пароли не совпадают';
    }
}
?>

<form action="/dmitry/lesson48-51/register.php" method="POST">
    <input name="login"/>
    <input type="password" name="password"/>
    <input name="confirm" type="password">
    <input type="date" name="date"/>
    <input type="email" name="emailaddress">
    <input type="submit" value="Отправить"/>

</form>
