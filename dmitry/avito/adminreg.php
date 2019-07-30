<?php
/**
 * register.php
 *
 */

$len = strlen($_POST['password']);
if (empty($_POST['password']))
{
    echo 'Пустой пароль!';
}
else if ( !preg_match("/^[\w\d\s]*$/", $_POST['password']) ) // только латиница и цифры
{
    echo 'В пароле должны быть только цифры или латинские буквы!';
}
else if ( ($len < 4) or ($len > 10) )
{
    echo 'Некорректная длина пароля!';
}
else if ( !empty($_POST['login']) and (!empty($_POST['password'])) and !empty($_POST['confirm']) )
{
    if ($_POST['password'] == $_POST['confirm']) {
        $host = 'localhost'; //имя хоста, на локальном компьютере это localhost
        $user = 'root'; //имя пользователя, по умолчанию это root
        $password = ''; //пароль, по умолчанию пустой
        $db_name = 'anecdotes'; //имя базы данных

        //Соединяемся с базой данных используя наши доступы:
        $link = mysqli_connect($host, $user, $password, $db_name);
        mysqli_query($link, "SET NAMES 'utf8'");

        $login = $_POST['login'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        // Пробуем получить юзера с таким логином:
        $query = 'SELECT * FROM admins WHERE login=\'' . $login . '\'';
        $user = mysqli_fetch_assoc(mysqli_query($link, $query));

        // Если юзера с таким логином нет:
        if (empty($user)) {

            $query = 'INSERT INTO admins SET login=\'' . $login . '\', password=\'' . $password . '\'';

            mysqli_query($link, $query);
            ?>
            <p>Пользователь зарегистрирован</p>
            <p><a  href="/dmitry/anecdotes/adminlogin.php">Залогиниться</a></p>
<?php
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

<form method="POST">
    <p>login: <label><input name="login"/></label></p>
    <p>Password<input type="password" name="password"></p>
    <p>Confirm<input type="password" name="confirm"></p>
    <p><input type="submit" value="Отправить"></p>
</form>
