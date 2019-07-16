<?php
/**
 * register.php
 *
 * Урок 52 Валидация данных
 * Задача 1: Модифицируйте ваш код так, чтобы нельзя было зарегистрировать пользователя с пустым логином или паролем.
 *
 * Задача 2: Модифицируйте ваш код так, чтобы логин мог содержать только латинские буквы и цифры.
 * В случае, если это не так, выводите сообщение об этом над формой.
 *
 * Задача 3:
 * Модифицируйте ваш код так, чтобы логин был длиной от 4 до 10 символов. В случае, если это не так, выводите сообщение
 * об этом над формой.
 *
 * Задача 4:
 * Модифицируйте ваш код так, чтобы пароль был длиной от 6 до 12 символов. В случае, если это не так, выводите сообщение
 * об этом над формой.
 *
 * Задача 5:
 * Модифицируйте ваш код так, чтобы, если логин или пароль вбиты некорректно, над соответствующим инпутом выводилось
 * сообщение об этом.
 *
 * Задача 6:
 * Спросите у пользователя при регистрации еще и email. Занесите его в базу данных. Выполните проверку емейла на
 * корректность и, если он некорректен, над соответствующим инпутом выведите сообщение об этом.
 *
 * Задача 7:
 * Спросите у пользователя при регистрации еще и дату рождения в формате "день.месяц.год". Занесите дату в базу данных.
 * Выполните проверку даты на соответствие формату.
 *
 * Задача 8:
 * Спросите у пользователя при регистрации еще и страну проживания. Предложите ему выбрать одну из стран с помощью
 * выпадающего списка select.
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
