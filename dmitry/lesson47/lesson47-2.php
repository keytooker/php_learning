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
* Урок 47 - 23
  Генеологическое дерево. Пользователь, его бабушки, дедушки, мама, папа, братья, сестры, дети. Можно найти любого родственника в любом колене (например, пра-пра-пра-дедушку). То есть есть пользователь, он может быть сыном, отцом, братом, дедушкой, прадедушкой и все это одновременно. Нужно хранить и получать родственные связи.  
  

*/

  $db_name = 'lesson_47_2'; //имя базы данных

//Соединяемся с базой данных используя наши доступы:
$link = mysqli_connect($host, $user, $password, $db_name);

//Устанавливаем кодировку (не обязательно, но поможет избежать проблем):
mysqli_query($link, "SET NAMES 'utf8'");

// (1)  получить отца пользователя, 
 $query = 'SELECT children.name AS user, parents.name AS dad FROM family_tree AS children
 LEFT JOIN family_tree AS parents ON children.father = parents.id
 WHERE children.name = \'Онопко Наталья\'';

// (2) получить мать пользователя,
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

// (5) получить дочерей пользователя,
 $query = 'SELECT children.name AS dot, users.name AS parent FROM family_tree AS users
 LEFT JOIN family_tree AS children ON children.mother = users.id OR children.father = users.id
 WHERE users.name =  \'Архипов Мирон\' AND children.sex = \'female\'';

// (6) получить внуков пользователя,
 $query = 'SELECT grandson.name AS grandson, users.name AS parent FROM family_tree AS users
 LEFT JOIN family_tree AS children ON children.mother = users.id OR children.father = users.id
 LEFT JOIN family_tree AS grandson ON grandson.mother = children.id OR grandson.father = children.id
 WHERE users.name =  \'Архипов Пантелеймон\'';

//  (7) получить бабушек пользователя, 
 $query = 'SELECT grandmo.name AS grandmo, users.name AS grandson FROM family_tree AS users
 LEFT JOIN family_tree AS parent ON users.mother = parent.id OR users.father = parent.id
 LEFT JOIN family_tree AS grandmo ON parent.mother = grandmo.id OR parent.father = grandmo.id
 WHERE users.name =  \'Онопко Екатерина\' AND grandmo.sex = \'female\'';

//   (8) получить дедушек пользователя, 
  $query = 'SELECT grandfa.name AS grandfa, users.name AS grandson FROM family_tree AS users
 LEFT JOIN family_tree AS parent ON users.mother = parent.id OR users.father = parent.id
 LEFT JOIN family_tree AS grandfa ON parent.mother = grandfa.id OR parent.father = grandfa.id
 WHERE users.name =  \'Онопко Екатерина\' AND grandfa.sex = \'male\'';

//  (9) получить пра-пра-пра-дедушку пользователя, 
   $query = 'SELECT grand4.name AS grand4, users.name AS grandson FROM family_tree AS users
 LEFT JOIN family_tree AS parent ON users.mother = parent.id OR users.father = parent.id
 LEFT JOIN family_tree AS grand1 ON parent.mother = grand1.id OR parent.father = grand1.id
  LEFT JOIN family_tree AS grand2 ON grand1.mother = grand2.id OR grand1.father = grand2.id
    LEFT JOIN family_tree AS grand3 ON grand2.mother = grand3.id OR grand2.father = grand3.id
      LEFT JOIN family_tree AS grand4 ON grand3.mother = grand4.id OR grand3.father = grand4.id
 WHERE users.name =  \'Онопко Екатерина\' AND grand4.sex = \'male\'';

//  (10) получить братьев и сестер пользователя, 
$query = 'SELECT users.name AS user, siblings.name AS sibling FROM family_tree AS users
LEFT JOIN family_tree AS siblings ON siblings.father = users.father OR siblings.mother = users.mother
WHERE siblings.id != users.id';

//  (11) получить братьев пользователя, 
$query = 'SELECT users.name AS user, siblings.name AS sibling FROM family_tree AS users
LEFT JOIN family_tree AS siblings ON siblings.father = users.father OR siblings.mother = users.mother
WHERE siblings.id != users.id AND siblings.sex = \'male\'';

//  (12) получить дядь и теть пользователя, 
$query = 'SELECT users.name AS user, au.name AS au FROM family_tree AS users
LEFT JOIN family_tree AS parants ON users.father = parants.id OR users.mother = parants.id
LEFT JOIN family_tree AS au ON au.father = parants.father OR au.mother = parants.mother
WHERE au.id != parants.id';

//  (13) получить кузенов и кузин пользователя.
$query = 'SELECT users.name AS user, cous.name AS cousin FROM family_tree AS users
LEFT JOIN family_tree AS parants ON users.father = parants.id OR users.mother = parants.id
LEFT JOIN family_tree AS au ON au.father = parants.father OR au.mother = parants.mother
LEFT JOIN family_tree AS cous ON cous.father = au.id OR cous.mother = au.id
WHERE au.id != parants.id AND users.name =  \'Онопко Екатерина\'';



/**

47 - 27 Как реализовать?
  Удаление пользователей, которые не заходили на сайт более 3-х месяцев. 
INSERT INTO `users` (`id`, `login`, `access_to`, `last_visit`) VALUES (NULL, 'nikolay', '2019-06-29', '2019-02-13');
DELETE FROM users WHERE last_visit < (NOW() - INTERVAL 3 MONTH);
*/


/**

47 - 28 Как реализовать?
  Активация аккаунта пользователя через email сразу после регистрации. 
  UPDATE users SET status = TRUE WHERE email = 'ivanov@mail.com';
*/

/**

47 - 30 Как реализовать?
  Есть тест с 500 вопросами. Покажите пользователю 20 случайных вопросов.

 $i = 1;
do {
  $query = 'INSERT INTO `test` (`q`) VALUES (\'Question ' . $i . '\')';
  make_query($link, $query);
  $i++;
} while ($i <= 500);


$query = 'SELECT `q` FROM `test` ORDER BY RAND() LIMIT 20';
*/






$data = make_query($link, $query);
?>

<pre>
    <?php
    var_dump($data);
    ?>
</pre>