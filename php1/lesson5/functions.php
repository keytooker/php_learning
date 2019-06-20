<?php

// Функция getUsersList() пусть возвращает массив всех пользователей и хэшей их паролей
function getUsersList()
{
    $file_path = __DIR__ . '/users.txt';
    $users_info = file($file_path);

    $users_list = [];
    foreach ($users_info as $ui) {
        $pair = explode(' ', $ui);
        $users_list[$pair[0]] = trim($pair[1]);
    }
    return $users_list;
}

// Функция existsUser($login) проверяет - существует ли пользователь с заданным логином?
function existsUser($login)
{
    $users = getUsersList();
    if ( array_key_exists($login, $users) )
    {
        return true;
    }
    else
    {
        return false;
    }
}

// Функция сheckPassword($login, $password) пусть возвращает true тогда, когда существует пользователь с указанным
// логином и введенный им пароль прошел проверку
function сheckPassword($login, $password)
{
    if ( !existsUser($login) )
    {
        return false;
    }

    $usersList = getUsersList();
    $hash = $usersList[$login];

    if ( password_verify( $password, $hash) )
    {
        return true;
    }
    else {
        return false;
    }
}

// getCurrentUser() возвращает либо имя вошедшего на сайт пользователя, либо null
function getCurrentUser()
{
    session_start();
    if ( isset($_SESSION['user']) )
    {
        return $_SESSION['user'];
    }
    else
    {
        return null;
    }
}