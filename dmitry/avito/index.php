<?php

include __DIR__ . '/elems/init.php';

$table_name = 'category';


$query = 'SELECT id AS category_id, name AS category_name FROM ' . $table_name;
$result = mysqli_query($link, $query) or die(mysqli_error($link));
for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row) ;
$content = '<h3 id="wrapper">Список категорий</h3><div class="dropdown" id="wrapper">
 <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown">All Category
 <span class="caret"></span></button>
 <ul class="dropdown-menu">';

foreach ($data as $elem)
{
    $content .= '<li><a href="/dmitry/avito/ads.php?categoryid=' . $elem['category_id'] . '">' . $elem['category_name'] . '</a></li>
 
 <li class="divider"></li>';
    //$content = $content . '<p><a href="/dmitry/avito/ads.php?categoryid=' . $elem['category_id'] . '">' . $elem['category_name'] . '</a></p>';
}

$content .= '</ul></div>';

if (isset($_GET['page']) and ($_GET['page'] > 0)) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

$notes_on_page = 3;
$content .= '<div id="wrapper">
    <h1>Объявы</h1><div>
    <nav>
        <ul class="pagination">
            <li class="disabled">';

if (1 == $page) {
    $prev = $page;
} else {
    $prev = $page - 1;
}
$content .=
    '<a href="?page=<?php echo $prev; ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>';


// запрос с сортировкой по времени от новых записей к старым
//$query = 'SELECT * FROM ads WHERE approved = 1 ORDER BY time DESC';
$query = 'SELECT * FROM ads';

//Делаем запрос к БД, результат запроса пишем в $result:
$result = mysqli_query($link, $query) or die(mysqli_error($link));
for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row) ;

$count = count($data);
$pages = ceil($count / $notes_on_page);

for ($i = 1; $i <= $pages; $i++) {

    if ($i == $page) {
        $content .=
            '<li class="active"><a href="?page=' . $i . '">' . $i . '</a></li>';

    } else {
        $content .=
            '<li>
                        <a href="?page=' . $i . '">' . $i . '</a>
                    </li>';

    }
}
$content .=
    '<li>
                <a href="?page=' . $pages . '" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>


<div class="note">';

$from = ($page - 1) * $notes_on_page;
//$query = 'SELECT * FROM ads WHERE id > 0 ORDER BY time DESC LIMIT ' . $from .',' . $notes_on_page;
$query = 'SELECT * FROM ads WHERE id > 0 ORDER BY id DESC LIMIT ' . $from . ',' . $notes_on_page;
$result = mysqli_query($link, $query) or die(mysqli_error($link));

for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row) ;

foreach ($data as $elem) {
    $content .= '<p>
            <span class="date">' . $elem['time'] . '</span>
            <span class="name">' . $elem['text'] . '</span>
        </p>

        <p>' . $elem['message'] . '</p';

}

$content .= '</div>';


include 'layout.php';



