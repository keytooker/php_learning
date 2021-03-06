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
        $categories[$record['category_name']] = $record['category_id'];
    }

    if (!empty($_POST))
    {
        if (isset($_POST['name']) and ($_POST['name'] != '') and !empty($_POST['joke'])) {

            $name = $_POST['name'];
            $joke = $_POST['joke'];
            $cid = $categories[$_POST['category']];
            $timestamp = time();
            $query = 'INSERT INTO records (text, author, approved, time, category) 
                      VALUES (\'' . $joke . '\', \'' . $name . '\', 0, NOW(), ' . $cid . ')';

            $write_res = mysqli_query($link, $query) or die(mysqli_error($link));
        }
    }

    if ( isset($_GET['page']) and ($_GET['page'] > 0) )
    {
        $page = $_GET['page'];
    }

    else {
        $page = 1;
    }

    $notes_on_page = 5;
    ?>

    <div>
        <nav>
            <ul class="pagination">
                <li class="disabled">
                    <?php
                    if ( 1 == $page)
                    {
                        $prev = $page;
                    }
                    else
                    {
                        $prev = $page - 1;
                    }
                    ?>
                    <a href="?page=<?php echo $prev; ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                <?php

    // запрос с сортировкой по времени от новых записей к старым
    $query = 'SELECT * FROM records WHERE approved = 1 ORDER BY time DESC';

    //Делаем запрос к БД, результат запроса пишем в $result:
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    //Преобразуем то, что отдала нам база в нормальный массив PHP $data:
    for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row) ;

                $count = count($data);
                $pages = ceil($count / $notes_on_page);

                for ($i = 1; $i <= $pages; $i++)
                {

                if ($i == $page)
                {
                ?>
                <li class="active"><a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                <?php
                }
                else {
                ?>
                <li>
                    <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
                <?php
                }
                }
                ?>
                <li>
                    <a href="?page=<?php echo $pages; ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>


    <div class="note">
        <?php
        $from = ($page - 1) * $notes_on_page;
        $query = 'SELECT * FROM records WHERE id > 0 ORDER BY time DESC LIMIT ' . $from .',' . $notes_on_page;
        $result = mysqli_query($link, $query) or die(mysqli_error($link));

        for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);

        foreach ($data as $elem) {
        ?>
        <p>
            <span class="date"><?php echo $elem['time']; ?></span>
            <span class="name"><?php echo $elem['text']; ?></span>
        </p>

        <p>
            <?php echo $elem['message']; ?>
        </p>
        <?php
        }
        ?>
    </div>

    <div class="info alert alert-info">
        <?php
        if ($write_res !== false)
            echo 'Запись успешно сохранена!';
        ?>
    </div>

    <div id="form">
        <form action="/dmitry/anecdotes/index.php" method="POST">
            <p><input class="form-control" placeholder="Ваше имя" name="name"></p>
            <p><textarea class="form-control" placeholder="Ваш анекдот" name="joke"></textarea></p>
            <p>
                Категория: <select name="category" class="form-control">
                    <?php
                    foreach ($categories as $name => $id) {
                        echo '<option value="'.$name.'">' . $name . '</option>';
                    }
                    ?>
                </select>
            </p>
            <p><input type="submit" class="btn btn-info btn-block" value="Отправить"></p>

        </form>
    </div>
</div>
</body>
</html>

