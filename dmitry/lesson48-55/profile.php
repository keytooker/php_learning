<?php
if (isset($_GET['id']))
{
    $host = 'localhost'; //имя хоста, на локальном компьютере это localhost
    $user = 'root'; //имя пользователя, по умолчанию это root
    $password = ''; //пароль, по умолчанию пустой
    $db_name = '48-55'; //имя базы данных

    //Соединяемся с базой данных используя наши доступы:
    $link = mysqli_connect($host, $user, $password, $db_name);
    mysqli_query($link, "SET NAMES 'utf8'");

    $id = $_GET['id'];

    // Пробуем получить юзера с таким логином:
    $query = 'SELECT * FROM users WHERE id=\'' .$id . '\'';
    $user = mysqli_fetch_assoc(mysqli_query($link, $query));

    // Если юзера с таким логином нет:
    if ( !empty($user) ) {
        ?>
        <p>
        Логин:
<?php echo $user['login'];
        ?>
        </p>

<p>
    Имя: <?= $user['name'] ?>
</p>
<p>
    Отчество: <?= $user['patronymic'] ?>
</p>
<p>
    Фамилия: <?= $user['surname'] ?>
</p>
<p>
    Возраст: <?php
    echo ( floor((time() - strtotime($user['date'])) / 31556926) );
     ?>
</p>
<?php
    }
    else {
        echo 'Пользователь с id = ' . $id . ' не найден.';
    }
}
