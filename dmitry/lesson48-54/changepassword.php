<?php
/**
 * changepassword.php
 *
 * Урок 54
 * Задача 5
 * Реализовать смену пароля
 */

session_start();

//  в начале обязательно следует сделать проверку на то, авторизован ли пользователь вообще.
if ( isset($_SESSION['auth']) and ($_SESSION['auth'] == true) and (!empty($_POST)) ) {
    $id = $_SESSION['id']; // id юзера из сессии
    var_dump($_SESSION);
    $host = 'localhost'; //имя хоста, на локальном компьютере это localhost
    $user = 'root'; //имя пользователя, по умолчанию это root
    $password = ''; //пароль, по умолчанию пустой
    $db_name = '48-55'; //имя базы данных

    //Соединяемся с базой данных используя наши доступы:
    $link = mysqli_connect($host, $user, $password, $db_name);
    mysqli_query($link, "SET NAMES 'utf8'");

    $query = "SELECT * FROM users WHERE id='$id'"; // получаем юзера по $id из сессии
    $result = mysqli_query($link, $query);
    $user = mysqli_fetch_assoc($result);

    $hash = $user['password']; // соленый пароль из БД
echo 'hash ' . $hash;
echo '<br>';
echo 'od';
// Проверяем соответствие хеша из базы введенному старому паролю
    if (password_verify($_POST['old_password'], $hash)) {
        // Все ок, меняем пароль...
        echo '<br>';
        echo 'Все ок, меняем пароль...';
        echo '<br>';

        // Хеш нового пароля:
        $newPasswordHash = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

        if ($_POST['new_password'] == $_POST['confirm']) {
            // Выполним UPDATE запрос:
            $query = 'UPDATE users SET password=\'' . $newPasswordHash . '\' WHERE id=' . $id;
            echo $query;
            mysqli_query($link, $query);

            echo 'Пароль сменен.';
        }
        else
        {
            echo 'Пароли не совпадают.';
        }
    } else {
        // Старый пароль введен неверно, выведем сообщение
        echo 'Старый пароль введен неверно!';
    }
}

?>

<form method="POST" xmlns="http://www.w3.org/1999/html">
    <p>login: <label><input name="login"/></label></p>

    <p>старый: <label><input type="password" name="old_password"/></label></p>
    <p>новый: <label><input type="password" name="new_password"/></label></p>
    <p>подтвердить: <label><input name="confirm" type="password"></label></p>
    <input type="submit" value="Отправить"/>
</form>