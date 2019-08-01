
<?php
/**
 * register.php
 */

include __DIR__ . '/elems/init.php';

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


        $login = $_POST['login'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        // Пробуем получить юзера с таким логином:
        $query = 'SELECT * FROM users WHERE login=\'' . $login . '\'';
        $user = mysqli_fetch_assoc(mysqli_query($link, $query));

        // Если юзера с таким логином нет:
        if (empty($user)) {

            $query = 'INSERT INTO users SET login=\'' . $login . '\', password=\'' . $password . '\'';

            mysqli_query($link, $query);
            ?>
            <p>Пользователь зарегистрирован</p>
            <p><a  href="/dmitry/avito/login.php">Залогиниться</a></p>
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

<?php
include 'layout.php';



