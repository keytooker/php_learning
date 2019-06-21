<?php

include __DIR__ . '/functions.php';

session_start();

// ЕСЛИ введены данные в форму входа - проверяем им (см. пункт 1.3) и ЕСЛИ проверка прошла,
// ТО запоминаем информацию о вошедшем пользователе
if ( isset($_POST['login']) and isset($_POST['password']) )
{
    if ( сheckPassword($_POST['login'], $_POST['password']) )
    {
        $_SESSION['user'] = $_POST['login'];
        $_SESSION['auth'] = true;
    }
}

if ( isset($_SESSION['auth']) ) // ЕСЛИ пользователь уже вошел (см. пункт 2), ТО редирект на главную страницу
{
    if ( true === $_SESSION['auth'] )
        header('Location: /php1/lesson5/index.php');
}
else // ЕСЛИ пользователь не вошел - отображает форму входа
{
    ?>

    <form method="post">
        <table>
            <tr>
                <td><label for="loginField">Логин</label></td>
                <td><input type="text" name="login"></td>
            </tr>
            <tr>
                <td><label for="passField">Пароль</label></td>
                <td><input type="password" name="password"></td>
            </tr>
            <tr>
                <td><input type="submit" value="Войти"></td>
            </tr>
        </table>
    </form>

    <?php
}



