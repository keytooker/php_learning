<?php
/**
 * admin.php
 */

session_start();
$content = 'Добро пожаловать, ' . $_SESSION['login'] . '! Ваш статус: ' . $_SESSION['status'] . ' ';
if ($_SESSION['status'] == 'admin') {
    $content .= '<a href="/dmitry/lesson48-55/admin.php">Админка</a>';
}
$content .= '<br>';

if ( ($_SESSION['auth'] == true) and ($_SESSION['status'] == 'admin') )
{
    $host = 'localhost'; //имя хоста, на локальном компьютере это localhost
    $user = 'root'; //имя пользователя, по умолчанию это root
    $password = ''; //пароль, по умолчанию пустой
    $db_name = '48-55'; //имя базы данных

    //Соединяемся с базой данных используя наши доступы:
    $link = mysqli_connect($host, $user, $password, $db_name);
    mysqli_query($link, "SET NAMES 'utf8'");

    if (isset($_GET['status']) and (isset($_GET['id'])))
    {
        $id = $_GET['id'];
        $query = 'UPDATE users SET status=\'' . $_GET['status'] . '\' WHERE id=' . $id;

        mysqli_query($link, $query);

    }

    $login = $_SESSION['login'];

    // Пробуем получить юзера с таким логином:
    $query = 'SELECT * FROM users';
    $result = mysqli_query($link, $query) or die( mysqli_error($link) );
    for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);

    $content .= '
    <p>
        Список пользователей:
    </p>
    <table>
        <tr>
            <td>Логин</td>
            <td>Статус</td>
        </tr>
';
    foreach ($data as $user)
    {
        if ($user['status'] == 'admin') {
            $color = 'red';
            $other_status = 'user';
        }
        else if ($user['status'] == 'user') {
            $color = 'green';
            $other_status = 'admin';
        }
        $is_admin = ($user['status'] === 'admin');

        $content .=
        '<tr>

            <td>
                <font color="' . $color . '">' . $user['login'] . '</font>
            </td>
            <td>
                <font color="' . $color . '"> ' . $user['status'] . '</font>

            </td>
            <td>
                <a href="/dmitry/lesson48-55/del.php?id=' . $user['id'] . '"> <font color="' . $color . '">Удалить</font></a>
            </td>

                <td>
                    <a href="/dmitry/lesson48-55/admin.php?id=' . $user['id'] . '&status=' . $other_status . '">
                        <font color="' . $color . '">Поменять статус на ' . $other_status . '
                        </font>
                    </a>
                </td>

        </tr>';
    }

    $content .= '</table>';
}
else
{
    echo 'У вас недостаточно прав для просмотра этой страницы.';
}

include 'layout.php';