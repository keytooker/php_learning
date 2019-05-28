<?php

//Устанавливаем доступы к базе данных:
$host = 'localhost'; //имя хоста, на локальном компьютере это localhost
$user = 'root'; //имя пользователя, по умолчанию это root
$password = ''; //пароль, по умолчанию пустой
$db_name = 'test'; //имя базы данных

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
var_dump($data);
    return $data;
}

/**
 *Простое связывание
5
Пользователь, его город. Запросы:
 * (1) достать пользователей вместе с их городом,
 * (2) достать все города,
 * (3) достать всех пользователей из города Минск,
 * (4) достать все города, в которых есть пользователи,
 * (5) достать все города, в которых нет пользователей,
 * (6) вывести список городов с количеством пользователей в них,
 * (7) вывести список городов, в которых количество пользователей больше трех.

 */

// (1)
$query = 'SELECT users.name AS user, cities.name AS city FROM users 
           LEFT JOIN cities ON users.city_id = cities.id';

// (2)
$query = 'SELECT cities.name AS city FROM cities';

// (3)
$query = 'SELECT users.name FROM users JOIN cities ON users.city_id = cities.id WHERE cities.name = \'Minsk\'';

// (4)
$query = 'SELECT cities.name AS city FROM cities RIGHT JOIN users ON users.city_id = cities.id';

// (5)
$query = 'SELECT *, cities.name AS city FROM cities  LEFT JOIN  users ON cities.id = users.city_id WHERE users.id IS NULL';

// (6)
$query = 'SELECT cities.name, COUNT(users.id) as city_users
  FROM cities LEFT JOIN users ON (cities.id = users.city_id)
 GROUP BY cities.id';

// (7)
$query = 'SELECT * FROM cities  
  RIGHT JOIN (SELECT cities.id AS city_id, COUNT(users.id) as ucount
  FROM cities LEFT JOIN users ON (cities.id = users.city_id)
 GROUP BY cities.id) AS city_users ON cities.id = city_users.city_id WHERE city_users.ucount > 3';


/**
 *  6 Пользователь, его город, страна. Запросы: (1) достать всех пользователей вместе с их городом и страной,
 * (2) достать все города с их странами,
 * (3) достать всех пользователей из страны Беларусь (без городов),
 * (4) достать всех пользователей из города Минск (без страны),
 * (5) вывести список стран с количеством пользователей в них.
 */

//(1)
$query = 'SELECT users.name AS user_name, cities.name AS city, countries.name AS country FROM users 
            LEFT JOIN cities ON users.city_id = cities.id
            LEFT JOIN countries ON cities.country_id = countries.id';

// (2)
$query = 'SELECT cities.name AS city, countries.name AS country FROM cities
          LEFT JOIN countries ON cities.country_id = countries.id';

// (3)
$query = 'SELECT users.name AS user_name FROM users
          LEFT JOIN cities ON users.city_id = cities.id
          LEFT JOIN countries ON cities.country_id = countries.id
          WHERE countries.name = \'Belarus\'';

// (4)
$query = 'SELECT users.name AS user_name FROM users
          LEFT JOIN cities ON users.city_id = cities.id
          WHERE cities.name = \'Minsk\'';

// (5)
$query = 'SELECT countries.name, COUNT(users.id) as country_users FROM countries
      LEFT JOIN cities ON (countries.id = cities.country_id)
      LEFT JOIN users ON (cities.id = users.city_id)
 GROUP BY countries.id';

/**
 * Урок 47 - 7
 * У отца всегда только один сын. Сыновья в свою очередь также могут быть отцами. Запросы:
 * (1) получить пользователя вместе с его отцом и сыном,
 * (2) получить дедушку пользователя,
 * (3) получить прадедушку пользователя.
 */

// (1)
$query = 'SELECT family.name AS user_name, sons.name as son_name, father.name AS father_name
FROM family
LEFT JOIN family as sons ON sons.id = family.son_id
LEFT JOIN family AS father ON father.son_id = family.id';

// (2)
$query = 'SELECT family.name AS user_name, grandfa.name AS grandfa
FROM family
LEFT JOIN family AS father ON father.son_id = family.id
LEFT JOIN family AS grandfa ON grandfa.son_id = father.id 
WHERE grandfa.name IS NOT NULL';

// (3)
$query = 'SELECT family.name AS user_name, grandgrandfa.name AS grandgrandfa
FROM family
LEFT JOIN family AS father ON father.son_id = family.id
LEFT JOIN family AS grandfa ON grandfa.son_id = father.id 
LEFT JOIN family AS grandgrandfa ON grandgrandfa.son_id = grandfa.id
WHERE grandgrandfa.name IS NOT NULL';

/**
 * Урок 47 - 8
 * Есть мужья и жены, а также неженатые/незамужние. Для всех указывается имя, фамилия, возраст, адрес. Муж с женой имеют одну фамилию и живут по одному адресу. Запросы: 
 (1) получить мужей с женами и наоборот, 
 (2) получить холостых, 
 (3) получить семьи (муж+жена), семьи не должны дублироваться (пара должна быть только 1 раз).
 */

 // (1)
$query = 'SELECT family.name AS user_name, family.surname AS user_surname, rel.name AS consort_name, rel.surname AS consort_surname FROM family
 LEFT JOIN family AS rel ON rel.id = family.consort WHERE (rel.address = family.address AND rel.surname = family.surname)'; //  

// (2)
$query = 'SELECT family.name AS user_name, family.surname AS user_surname FROM family
 LEFT JOIN family AS rel ON rel.id = family.id WHERE family.consort IS NULL'; //  

// (3)
$query = 'SELECT DISTINCT family.surname FROM family
 LEFT JOIN family AS rel ON rel.id = family.consort WHERE (rel.address = family.address AND rel.surname = family.surname)';

 $query = 'SELECT DISTINCT family.surname, rel2.name AS family_surname FROM family
 LEFT JOIN family AS rel ON rel.id = family.consort 
 WHERE (rel.address = family.address AND rel.surname = family.surname)';

$data = make_query($link, $query);
?>
<pre>
    <?php
    var_dump($data);
    ?>
</pre>
