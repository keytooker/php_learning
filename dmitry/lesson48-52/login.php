<?php

/**
login.php
*/

if ( !empty($_POST['login']) AND !empty($_POST['password']) )
{
    $host = 'localhost'; //имя хоста, на локальном компьютере это localhost
	$user = 'root'; //имя пользователя, по умолчанию это root
	$password = ''; //пароль, по умолчанию пустой
	$db_name = '48-55'; //имя базы данных

	//Соединяемся с базой данных используя наши доступы:
	$link = mysqli_connect($host, $user, $password, $db_name);
	mysqli_query($link, "SET NAMES 'utf8'");

	$login = $_POST['login'];

	//$query = 'SELECT * FROM users WHERE login=\'' . $login . '\' AND password=\'' . $password . '\'';
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
            header('Location: /dmitry/lesson48-52/index.php');
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
	<input name="login">
	<input type="password" name="password">
	<input type="submit" value="Отправить">
</form>
<?php
}