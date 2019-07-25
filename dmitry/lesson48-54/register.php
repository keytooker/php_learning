<?php
/**
 * register.php
 *
 */

if (empty($_POST['password']))
{
    echo 'Пустой пароль!';
}
else if ( !preg_match("/^[\w\d\s]*$/", $_POST['password']) ) // только латиница и цифры
{
    echo 'В пароле должны быть только цифры или латинские буквы!';
}
else if ( (strlen($_POST['password']) < 4) or (strlen($_POST['password']) > 10) )
{
    echo 'Некорректная длина пароля!';
}
else if ( !empty($_POST['login']) and (!empty($_POST['password'])) and !empty($_POST['confirm']) )
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
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        // Пробуем получить юзера с таким логином:
        $query = 'SELECT * FROM users WHERE login=\'' . $login . '\'';
        $user = mysqli_fetch_assoc(mysqli_query($link, $query));

        // Если юзера с таким логином нет:
        if (empty($user)) {
            $date = date('Y-m-d', strtotime($_POST['date']));
            $email = $_POST['emailaddress'];

            $registration_date = date('Y-m-d'); // получим текущую дату средствами PHP

            $query = 'INSERT INTO users SET login=\'' . $login . '\', password=\'' . $password . '\', date=\'' . $date .
                '\', email=\'' . $email . '\', country=\'' . $_POST['country'] . '\', registration_date=\'' . $registration_date . '\'';
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

<form action="/dmitry/lesson48-52/register.php" method="POST" xmlns="http://www.w3.org/1999/html">
    <p>login: <label><input name="login"/></label></p>
    <input type="password" name="password"/>
    <input name="confirm" type="password">
    <input type="date" name="date"/>
    <input type="email" name="emailaddress">
    <input type="submit" value="Отправить"/>
    <p>
        country:
        <select name="country">
            <option value="Russia">Russia</option>
            <option value="Ukraine">Ukraine</option>
            <option value="Belarus">Belarus</option>
            <option value="USA">USA</option>
            <option value="Gonduras">Gonduras</option>
        </select>
    </p>
</form>
