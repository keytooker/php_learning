<?php
session_start();
$_SESSION['title'] = 'Новости';
$_SESSION['newspath'] = __DIR__ . '/news.txt';
$_SESSION['action'] = '/php1/lesson7/3/add.php';
$_SESSION['type'] = 'news';

require __DIR__ . '/../class/View.php';
require __DIR__ . '/../class/News.php';

$news = new News($_SESSION['newspath']);
$view = new View;
$view->add('news', $news);

const PATH = __DIR__ . '/../templates/index.php';
//$view->display(PATH);
echo $view->render(PATH);