<?php
/**
 * header.php
 */
function create_link($href, $text)
{
    $is_main = !isset($_GET['page']) and ( '/' == $href );
    $is_other = isset($_GET['page']) and ($_GET['page'] == $href) and !$is_other;

    if (
        ( !isset($_GET['page']) and ( '/' == $href ) ) or
        (isset($_GET['page']) and ( $_GET['page'] == $href ) )
    ) {
        $class = ' class="active"';
    }
    else if ($is_other) {
        $class = '';

    }

    if ($href != '/') {
        $href_part  = '/?page=';
    } else {
        $href_part = '';
    }
    echo ' <a href="' . $href_part . $href . '"' . $class . '>' . $text . '</a> ';
}

/*
$query = 'SELECT * FROM ' . $table_name . ' WHERE url != \'404\'';
$result = mysqli_query($link, $query) or die( mysqli_error($link) );
for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
foreach($data as $record)
{
    create_link($record['url'], $record['title']);
}
*/