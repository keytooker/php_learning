<?php
//
// add.php
//

session_start();

require __DIR__ . '/../class/GuestBook.php';
$guestbook = new GuestBook($_SESSION['guestbookpath']);

$rec = new GuestBookRecord($_POST['message']);
$guestbook->append($rec);
$savingResult = $guestbook->save();

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
    <a href="/php1/lesson7/2/index.php">На главную гостевой книги</a>
</p>
