<?php
session_start();
$_SESSION['title'] = 'Гостевая книга';
$_SESSION['guestbookpath'] = __DIR__ . '/guestbook.txt';
$_SESSION['action'] = '/php1/lesson7/2/add.php';
$_SESSION['type'] = 'gb';

require __DIR__ . '/../class/View.php';
require __DIR__ . '/../class/GuestBook.php';

$guestbook = new GuestBook($_SESSION['guestbookpath']);
$view = new View;
$view->add($_SESSION['type'], $guestbook);

const PATH = __DIR__ . '/../templates/index.php';
//$view->display(PATH);
echo $view->render(PATH);