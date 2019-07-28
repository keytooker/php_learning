<?php

$host = 'localhost'; //имя хоста, на локальном компьютере это localhost
$user = 'root'; //имя пользователя, по умолчанию это root
$password = ''; //пароль, по умолчанию пустой
$db_name = 'anecdotes'; //имя базы данных

//Соединяемся с базой данных используя наши доступы:
$link = mysqli_connect($host, $user, $password, $db_name);

$query = 'SELECT * FROM records WHERE approved = 0 ORDER BY time DESC';

//Делаем запрос к БД, результат запроса пишем в $result:
$result = mysqli_query($link, $query) or die(mysqli_error($link));
//Преобразуем то, что отдала нам база в нормальный массив PHP $data:
for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row) ;
var_dump($data);
?>
<pre>
<table>
<?php
foreach ($data as $record) {
    ?>
    <tr class="note">
        <td>
            <span class="date">
                    <?php
                    $date = date_create($record['time']);
                    echo date_format($date,"Y/m/d H:i:s");
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

    </tr>
    <?php
}
?>
</table>
    </pre>