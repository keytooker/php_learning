<?php
// upload_img.php

include __DIR__ . '/functions.php';

// Если пользователь авторизован
if (getCurrentUser() != null)
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
?>

<form enctype="multipart/form-data" action="upload_img.php" method="POST">
    Отправить этот файл: <input name="userfile" type="file"/>
    <input type="submit" value="Отправить файл"/>
</form>

