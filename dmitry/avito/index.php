
<?php

include __DIR__ . '/elems/init.php';

$table_name = 'category';


    $query = 'SELECT id AS category_id, name AS category_name FROM ' . $table_name;
    $result = mysqli_query($link, $query) or die( mysqli_error($link) );
    for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
    $content = '<h3>Список категорий</h3>';
    foreach ($data as $elem) {

        $content = $content . '<p><a href="/dmitry/avito/ads.php?categoryid=' . $elem['category_id'] . '">' . $elem['category_name'] . '</a></p>';
    }


include 'layout.php';



