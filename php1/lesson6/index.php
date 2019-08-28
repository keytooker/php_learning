<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<?php

include __DIR__ . '/guestbook.php';

$guestBook = new GuestBook(__DIR__ . '/guestbook.txt');

// Попробуйте некоторые методы заканчивать конструкцией return $this;
// и придумайте этому применение
$guestBook->append(PHP_EOL . 'TEST')->save();

?>

<form enctype="multipart/form-data" action="./uploader.php" method="POST">
    Отправить этот файл: <input name="userfile" type="file"/>
    <input type="submit" value="Отправить файл"/>
</form>

</body>
</html>