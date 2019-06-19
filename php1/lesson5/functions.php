<?php

// Функция getUsersList() пусть возвращает массив всех пользователей и хэшей их паролей
function getUsersList()
{
    return [
        'user' => password_hash('pass', PASSWORD_DEFAULT),
        'user2' =>  password_hash('pass2', PASSWORD_DEFAULT),
    ];
}

// Функция existsUser($login) проверяет - существует ли пользователь с заданным логином?
function existsUser($login)
{
    if ( array_key_exists($login, getUsersList()) )
    {
        return TRUE;
    }
    else
    {
        return FALSE;
    }
}

// Функция сheckPassword($login, $password) пусть возвращает true тогда, когда существует пользователь с указанным
// логином и введенный им пароль прошел проверку
function сheckPassword($login, $password)
{
    if ( existsUser($login) )
    {
        $usersList = getUsersList();
        if ( password_verify( $password, $usersList[$login]) )
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
}

// getCurrentUser() возвращает либо имя вошедшего на сайт пользователя, либо null
function getCurrentUser()
{
    if (isset($_COOKIE['current_user']))
    {
        return $_COOKIE['current_user'];
    }
    else
    {
        return null;
    }
}