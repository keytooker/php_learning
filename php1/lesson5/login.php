<?php

include __DIR__ . '/functions.php';

if ( isset($_POST['login']) && isset($_POST['password']) && сheckPassword($_POST['login'], $_POST['password']) )
{
    setcookie('current_user', $_POST['login']);
}

if ( getCurrentUser() != null )
{
    $host  = $_SERVER['HTTP_HOST'];
    $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $extra = 'index.php';
    header('Location: http://' . $host . $uri .'/' . $extra);
    exit;
}
else
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



