<?php
// upload_img.php

include __DIR__ . '/functions.php';

session_start();

// Если пользователь авторизован
if ( isset($_SESSION['auth']) )
{
    if ( isset($_FILES['userfile']) && (0 == $_FILES['userfile']['error']) )
    {
        $uploaddir = __DIR__ . '/images/';
        $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

        if ( move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile) ) 
        {
            $message = getCurrentUser() . ' ' .  date(DATE_RFC822) . ' ' . $_FILES['userfile']['name'] . PHP_EOL;
            $res = fopen(__DIR__ . '/log.txt', 'a');
            fwrite($res, $message);
            fclose($res);
            echo 'Файл был успешно загружен.';
        }
    }
}
else
{
    echo 'Вы не авторизованы';
}
?>

<p>
    <form enctype="multipart/form-data" action="upload_img.php" method="POST">
        Отправить этот файл: <input name="userfile" type="file"/>
        <input type="submit" value="Отправить файл"/>
    </form>
</p>

<p>
    <a href="/php1/lesson5/index.php">На главную</a> | <a href="/php1/lesson5/login.php">login page</a>
</p>
