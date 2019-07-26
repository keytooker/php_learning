<?php
/**
 * admin.php
 */

session_start();
if ( ($_SESSION['auth'] == true) and ($_SESSION['status'] == 'admin') )
{
    echo 'Добро пожаловать, ' . $_SESSION['login'];
    ?>
<pre></pre>
<?php
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
    $query = 'SELECT * FROM users';
    $result = mysqli_query($link, $query) or die( mysqli_error($link) );
    for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
    ?>
    <p>
        Список пользователей:
    </p>
    <table>
        <tr>
            <td>Логин</td>
            <td>Статус</td>
        </tr>
<?php
    foreach ($data as $user)
    {
        ?>
        <tr>
            <td>
                <?= $user['login']; ?>
            </td>
            <td>
                <?= $user['status']; ?>
            </td>
        </tr>
        <?php
    }
    ?>
    </table>
        <?php
}
else
{
    echo 'У вас недостаточно прав для просмотра этой страницы.';
}