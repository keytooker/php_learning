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

<p>
    <a href="/php1/lesson7/index.php">На главную</a>
</p>

<?php
session_start();
$title = $_SESSION['title'];
$action = $_SESSION['action'];
$type = $_SESSION['type'];
?>

<h1><?= $title; ?></h1>

<?php
$records = $this->getData()[$type]->getData();
foreach ($records as $onerec)
{
    ?>
<article>
    <?= $onerec->getMessage() ?>
</article>
    <hr>
<?php
}
?>
<form action="<?= $action; ?>" method="post">
    <textarea name="message"></textarea>
    <br>
    <button type="submit">Добавить</button>
</form>
</body>
</html>
