<?php

//Устанавливаем доступы к базе данных:
$host = 'localhost'; //имя хоста, на локальном компьютере это localhost
$user = 'root'; //имя пользователя, по умолчанию это root
$password = ''; //пароль, по умолчанию пустой
$db_name = 'lesson_47_2'; //имя базы данных

//Соединяемся с базой данных используя наши доступы:
$link = mysqli_connect($host, $user, $password, $db_name);

//Устанавливаем кодировку (не обязательно, но поможет избежать проблем):
mysqli_query($link, "SET NAMES 'utf8'");

function make_query($link, $query)
{
//Делаем запрос к БД, результат запроса пишем в $result:
    $result = mysqli_query($link, $query) or die(mysqli_error($link));

//Преобразуем то, что отдала нам база в нормальный массив PHP $data:
    for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row) ;

    return $data;
}

/**
* Урок 47 - 18
  Генеологическое дерево. Пользователь, его бабушки, дедушки, мама, папа, братья, сестры, дети. Можно найти любого родственника в любом колене (например, пра-пра-пра-дедушку). То есть есть пользователь, он может быть сыном, отцом, братом, дедушкой, прадедушкой и все это одновременно. Нужно хранить и получать родственные связи.  
  (1) получить отца пользователя, 
  (2) получить мать пользователя, 
  
   
  (5) получить дочерей пользователя, 
  (6) получить внуков пользователя, 
  (7) получить бабушек пользователя, 
  (8) получить дедушек пользователя, 
  (9) получить пра-пра-пра-дедушку пользователя, 
  (10) получить братьев и сестер пользователя, 
  (11) получить братьев пользователя, 
  (12) получить дядь и теть пользователя, 
  (13) получить кузенов и кузин пользователя.
*/

  $db_name = 'lesson_47_2'; //имя базы данных

//Соединяемся с базой данных используя наши доступы:
$link = mysqli_connect($host, $user, $password, $db_name);

//Устанавливаем кодировку (не обязательно, но поможет избежать проблем):
mysqli_query($link, "SET NAMES 'utf8'");

// (1)
 $query = 'SELECT children.name AS user, parents.name AS dad FROM family_tree AS children
 LEFT JOIN family_tree AS parents ON children.father = parents.id
 WHERE children.name = \'Онопко Наталья\'';

// (2) 
 $query = 'SELECT children.name AS user, parents.name AS mother FROM family_tree AS children
 LEFT JOIN family_tree AS parents ON children.mother = parents.id
 WHERE children.name = \'Онопко Екатерина\'';

// (3) получить детей пользователя, 
 $query = 'SELECT children.name AS child, users.name AS parent FROM family_tree AS users
 LEFT JOIN family_tree AS children ON children.mother = users.id OR children.father = users.id
 WHERE users.name =  \'Архипов Иван\'';

// (4) получить сыновей пользователя,
$query = 'SELECT children.name AS son, users.name AS parent FROM family_tree AS users
 LEFT JOIN family_tree AS children ON children.mother = users.id OR children.father = users.id
 WHERE users.name =  \'Архипов Мирон\' AND children.sex = \'male\'';

$data = make_query($link, $query);
?>

<pre>
    <?php
    var_dump($data);
    ?>
</pre>