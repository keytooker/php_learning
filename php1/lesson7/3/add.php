<?php
//
// add.php
//

session_start();

require __DIR__ . '/../class/News.php';
$news = new News($_SESSION['newspath']);

$article = new Article($_POST['message']);
$news->append($article);
$savingResult = $news->save();

if ($savingResult)
{
    $message = 'Запись успешно добавлена';
}
else
{
    $message = 'Ошибка записи';
}
?>
<p>
    <?= $message; ?>
</p>
<p>
    <a href="/php1/lesson7/3/index.php">На главную новостей</a>
</p>
