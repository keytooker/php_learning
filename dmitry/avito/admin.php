<?php
include __DIR__ . '/elems/init.php';
session_start();
var_dump($_POST);
echo $_SESSION['login'];
?>

<p><a href="/dmitry/avito/">На главную</a></p>

<?php
if (isset($_SESSION['auth']) )
{
//Соединяемся с базой данных используя наши доступы:
    $link = mysqli_connect($host, $user, $password, $db_name);

    // Если было добавлено объявление
    if ( isset($_POST['title']) and isset($_POST['ad']) )
    {
        $query = 'SELECT id AS user_id FROM users WHERE login = \'' . $_SESSION['login'] . '\'';
        $result = mysqli_query($link, $query) or die(mysqli_error($link));
        $user_id = mysqli_fetch_assoc($result);

        $query = 'INSERT INTO ads SET title=\'' . $_POST['title'] . '\', text=\'' . $_POST['ad'] . '\',
            timeup = NOW(), user = \'' . $user_id . '\', ';

        mysqli_query($link, $query);
    }

    $query = 'SELECT * FROM ads';

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
    <p>У вас нет активных объявлений</p>
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