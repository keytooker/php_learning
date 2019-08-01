<?php
/**
 * login.php
 */
include __DIR__ . '/elems/init.php';


if ( !empty($_POST['login']) AND !empty($_POST['password']) )
{

    $login = $_POST['login'];

    $query = 'SELECT * FROM users WHERE login=\'' . $login . '\'';
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    $user = mysqli_fetch_assoc($result);

    if ( !empty($user) )
    {
        $hash = $user['password'];

        if (password_verify($_POST['password'], $hash)) {
            //echo 'Прошел авторизацию'; // если пользователь прошел авторизацию - выводилось сообщение об этом
            session_start();
            $_SESSION['message'] = ['text' => 'Вы вошли на сайт', 'status' => 'success'];
            $_SESSION['auth'] = true;
            $_SESSION['login'] = $login;
            $_SESSION['id'] = $user['id'];

            header('Location: /dmitry/avito/');
        }
        else {
            echo 'Неверный логин или пароль';
        }
    } else {
        echo 'Неверный логин или пароль';
    }
}
else
{
    ?>
    <form action="" method="POST">
        <p>login:<input name="login"></p>
        <p>Password<input type="password" name="password"></p>
        <p><input type="submit" value="Отправить"></p>
    </form>
    <?php
}


include 'layout.php';



