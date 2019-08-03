<?php

include __DIR__ . '/elems/init.php';

$table_name = 'pages';

session_start();
if ( isset($_GET['categoryid']) and ($_SESSION['auth'] === true) )
{
    $_SESSION['categoryid'] = $_GET['categoryid'];
    $content = '<div id="wrapper">
        <form action="/dmitry/avito/admin.php" method="POST">
            <p><input class="form-control" placeholder="Заголовок" name="title"></p>
            <p><textarea class="form-control" placeholder="Текст объявления" name="ad"></textarea></p>
            <p><input type="submit" class="btn btn-info btn-block" value="Отправить"></p>

        </form>
    </div>';
}
else
{
    $content = '<p>Пожалуйста, залогиньтесь</p>';
}



include 'layout.php';



