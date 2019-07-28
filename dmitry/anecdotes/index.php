<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Анекдоты</title>
    <link rel="stylesheet" href="css/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<div id="wrapper">
    <h1>Анекдоты</h1>
    <?php

    $host = 'localhost'; //имя хоста, на локальном компьютере это localhost
    $user = 'root'; //имя пользователя, по умолчанию это root
    $password = ''; //пароль, по умолчанию пустой
    $db_name = 'anecdotes'; //имя базы данных

    //Соединяемся с базой данных используя наши доступы:
    $link = mysqli_connect($host, $user, $password, $db_name);

    $write_res = false;

    // Вытащить категории и их id
    $query = 'SELECT id AS category_id, name AS category_name FROM categories';
    $result = mysqli_query($link, $query) or die( mysqli_error($link) );
    for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
    $categories = [];
    foreach ($data as $record) {
        $categories[$record['category_id']] = $record['category_name'];
    }
    var_dump($categories);

    if (!empty($_POST))
    {
        var_dump($_POST);
        if (isset($_POST['name']) and ($_POST['name'] != '') and !empty($_POST['joke'])) {

            $name = $_POST['name'];
            $joke = $_POST['joke'];
            $timestamp = time();
            $query = 'INSERT INTO records (text, author, approved, time) 
                      VALUES (\'' . $joke . '\', \'' . $name . '\', 0, NOW())';
            $write_res = mysqli_query($link, $query) or die(mysqli_error($link));
        }
    }

    // запрос с сортировкой по времени от новых записей к старым
    //$query = 'SELECT * FROM records WHERE approved = 1 ORDER BY time DESC';
    $query = 'SELECT * FROM records WHERE approved = 1 ORDER BY time DESC';

    //Делаем запрос к БД, результат запроса пишем в $result:
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    //Преобразуем то, что отдала нам база в нормальный массив PHP $data:
    for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row) ;
var_dump($data);
    foreach ($data as $record) {
        ?>
        <div class="note">
            <p>
                <span class="date">
                    <?php
                    $date = date_create($record['time']);
                    echo date_format($date,"Y/m/d H:i:s");
                    //echo(date("Y-m-d", $record['time']));
                    ?></span>
                <span class="name"><?php
                    echo $record['author'];
                    ?></span>
            </p>
            <p>
                <?php
                echo $record['text'];
                ?>
            </p>
        </div>
        <?php
    }
    ?>

    <div class="info alert alert-info">
        <?php
        if ($write_res !== false)
            echo 'Запись успешно сохранена!';
        ?>
    </div>
    <div id="form">
        <form action="/index.php" method="POST">
            <p><input class="form-control" placeholder="Ваше имя" name="name"></p>
            <p><textarea class="form-control" placeholder="Ваш анекдот" name="joke"></textarea></p>
            <p><input type="submit" class="btn btn-info btn-block" value="Отправить"></p>
        </form>
    </div>
</div>
</body>
</html>

