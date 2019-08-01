
<?php

include __DIR__ . '/elems/init.php';

$table_name = 'pages';

if ( isset($_GET['page']) )
{
    $page = $_GET['page'];

    $query = 'SELECT * FROM ' . $table_name . ' WHERE url = \'' . $page . '\'';
    $result = mysqli_query($link, $query) or die( mysqli_error($link) );
    $page = mysqli_fetch_assoc($result);

    $file = 'pages/' . $page . '.php';
    if ( NULL === $page ) {
        $query = 'SELECT * FROM ' . $table_name . ' WHERE url = \'404\'';
        $result = mysqli_query($link, $query) or die( mysqli_error($link) );
        $page = mysqli_fetch_assoc($result);

        header("HTTP/1.0 404 Not Found");
    }

    $content = $page['text'];
    $title = $page['title'];
}
else
{
    $query = 'SELECT id, url, title FROM ' . $table_name . ' WHERE url != \'404\' ORDER BY id DESC';
    $result = mysqli_query($link, $query) or die( mysqli_error($link) );
    for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
    $content = '<h3>Задача 25. Статьи сайта, отсортированные по убыванию даты добавления (то есть в начале самые новые)</h3>';
    foreach ($data as $page) {
        if ($page['url'] != '/') {
            $href_part  = '/?page=';
        } else {
            $href_part = '';
        }

       $content = $content . '<p><a href="' . $href_part . $page['url'] . '">' . $page['title'] . '</a></p>';
    }
}



include 'layout.php';



