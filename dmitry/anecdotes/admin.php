<?php

session_start();
?>
<p><a href="/dmitry/anecdotes/">На главную</a></p>
<?php
if (isset($_SESSION['auth']) ) {
    $host = 'localhost'; //имя хоста, на локальном компьютере это localhost
    $user = 'root'; //имя пользователя, по умолчанию это root
    $password = ''; //пароль, по умолчанию пустой
    $db_name = 'anecdotes'; //имя базы данных

//Соединяемся с базой данных используя наши доступы:
    $link = mysqli_connect($host, $user, $password, $db_name);

    // Если была попытка удалить или одобрить анекдот
    if ( isset($_GET['id']) and (isset($_GET['action'])) )
    {
        $id = $_GET['id'];

        if ($_GET['action'] == 0)
        {
            $allow = false;
        }
        else if ($_GET['action'] == 1)
        {
            $allow = true;
        }
        if ($allow)
        {
            $query = 'UPDATE records SET approved=1 WHERE id=' . $id;
            mysqli_query($link, $query) or die(mysqli_error($link));
        }
        else
        {
            $query = 'DELETE FROM records WHERE id=' . $id;
            $result = mysqli_query($link, $query) or die(mysqli_error($link));
            
        }
    }

    $query = 'SELECT * FROM records WHERE approved = 0 ORDER BY time DESC';

//Делаем запрос к БД, результат запроса пишем в $result:
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
//Преобразуем то, что отдала нам база в нормальный массив PHP $data:
    for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row) ;

    ?>
    <pre>
<table>
<?php
if (empty($data))
{
    ?>
    <p>Нет анекдотов, ожидающих доступа.</p>
    <?php
}

foreach ($data as $record) {
    ?>
    <tr class="note">
        <td>
            <span class="date">
                    <?php
                    $date = date_create($record['time']);
                    echo date_format($date, "Y/m/d H:i:s");
                    //echo(date("Y-m-d", $record['time']));
                    ?></span>
            <span class="name"><?php
                echo $record['author'];
                ?></span>
        </td>
        <td>
            <?php
            echo $record['text'];
            ?>
        </td>
        <td>
             <a href="/dmitry/anecdotes/admin.php?action=1&id=<?= $record['id']; ?>">Одобрить</a>
        </td>
        <td>
            <a href="/dmitry/anecdotes/admin.php?action=0&id=<?= $record['id']; ?>">Удалить</a>
        </td>

    </tr>
    <?php
}
?>
</table>
    </pre>

    <?php
}