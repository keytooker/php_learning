<?php

$p = include('password.php');
if ( isset($_POST['password']) and ( $p === md5($_POST['password'])) )
{
    session_start();
    $_SESSION['message'] = [ 'text' => 'Вы вошли на сайт', 'status' => 'success'];
    $_SESSION['auth'] = true;

    header('Location: /admin/');
    die();
}
else if ( isset($_POST['password']) and ( $p !== md5($_POST['password'])) )
{
    echo 'Пароль некорректен';
    $action = '/admin/login.php';
    include 'elem/pass_form.php';
}
else
{
    $action = '/admin/login.php';
    include 'elem/pass_form.php';
}