<?php
require __DIR__ . '/class/View.php';
require __DIR__ . '/class/GuestBook.php';
$guestbook = new GuestBook;
$view = new View;
$view->add('gb', $guestbook);
$view->display(__DIR__ . '/templates/index.php');