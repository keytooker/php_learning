<?php
/**
 * del.php
 */

session_start();
?>
<p>
Страница удаления пользователя. Вы вошли как <?= $_SESSION['login']; ?>
</p>
<?php

//  в начале обязательно следует сделать проверку на то, авторизован ли пользователь вообще.
if ( !isset($_SESSION['auth']) and ($_SESSION['auth'] != true) )
{
    die('авторизуйтесь');
}

$del_user_id = '';
$current_user_id =  $_SESSION['id'];

// если это admin хочет кого-то удалить
if ( isset($_GET['id']) and ($_SESSION['status'] == 'admin') )
{
    $del_user_id = $_GET['id'];
}
else // пользователь сам удаляет свой профиль
{
    $del_user_id = $_SESSION['id']; // id юзера из сессии
}

if ( !empty($_POST) ) {
    $host = 'localhost'; //имя хоста, на локальном компьютере это localhost
    $user = 'root'; //имя пользователя, по умолчанию это root
    $password = ''; //пароль, по умолчанию пустой
    $db_name = '48-55'; //имя базы данных

    //Соединяемся с базой данных используя наши доступы:
    $link = mysqli_connect($host, $user, $password, $db_name);
    mysqli_query($link, "SET NAMES 'utf8'");

    $query = "SELECT * FROM users WHERE id='$current_user_id'";
    $result = mysqli_query($link, $query);
    $current_user_info = mysqli_fetch_assoc($result);

    $hash = $current_user_info['password']; // соленый пароль из БД

// Проверяем соответствие хеша из базы введенному старому паролю
    if (password_verify($_POST['password'], $hash)) {

        if ($_POST['password'] == $_POST['confirm']) {
            $query = 'DELETE FROM users WHERE id=' . $del_user_id;

            mysqli_query($link, $query);

            echo 'Пользователь удален';
            unset( $_SESSION['auth'] );
        }
        else
        {
            echo 'Пароли не совпадают.';
        }
    } else {
        // Старый пароль введен неверно, выведем сообщение
        echo 'Неверный пароль';
    }
}

?>

<form method="POST">
    <p>пароль: <label><input type="password" name="password"/></label></p>
    <p>подтвердить: <label><input name="confirm" type="password"></label></p>
    <input type="submit" value="Удалить"/>
</form>