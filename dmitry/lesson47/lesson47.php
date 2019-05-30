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
 $query = 'SELECT * FROM (
      SELECT second.name AS user_name, rel.name AS consort_name, second.surname AS user_surname
      FROM family AS second
      LEFT JOIN family AS rel ON rel.id = second.consort
      WHERE (rel.address = second.address AND rel.surname = second.surname)
) AS first';

$families = [];
$data = make_query($link, $query);
foreach ($data as $pair) {
  ?>
<pre>
    <?php
    $surname = $pair['user_surname'];

    // если уже добавили эту пару
    if (isset($families[$surname]))
      continue;

    $consorts['first'] = $pair['user_name'];
    $consorts['second'] = $pair['consort_name'];

    $families[$surname] = $consorts;
    ?>
</pre>
<?php
}

$db_name = 'lesson47'; //имя базы данных

//Соединяемся с базой данных используя наши доступы:
$link = mysqli_connect($host, $user, $password, $db_name);

//Устанавливаем кодировку (не обязательно, но поможет избежать проблем):
mysqli_query($link, "SET NAMES 'utf8'");

/**
 * Урок 47 - 9
 *  Товар, который может принадлежать нескольким категориям одновременно. Запросы: 
 (1) достать все товары вместе с их категориями, 
 (2) достать товар 'Огурец' вместе с его категориями, 
 (3) достать все товары из категории 'Овощи', 
 (4) достать все товары, которые принадлежат более чем одной категории.
 */

// (1)
$query = 'SELECT product.name AS product_name, category.name AS category_name FROM product
LEFT JOIN rel ON rel.product_id = product.id
LEFT JOIN category ON rel.category_id = category.id';

// (2)
$query = 'SELECT product.name AS product_name, category.name AS category_name FROM product
 LEFT JOIN rel ON rel.product_id = product.id
LEFT JOIN category ON rel.category_id = category.id
WHERE product.name = \'Огурцы\'';

// (3)
$query = 'SELECT product.name AS product_name, category.name AS category_name FROM product
 LEFT JOIN rel ON rel.product_id = product.id
LEFT JOIN category ON rel.category_id = category.id
WHERE category.name = \'Овощи\'';

// (4)
$query = 'SELECT * FROM (SELECT sel_product.product_name AS product, COUNT(sel_product.product_name) AS product_count
FROM (SELECT product.name AS product_name, category.name AS category_name FROM product
LEFT JOIN rel ON rel.product_id = product.id
LEFT JOIN category ON rel.category_id = category.id) AS sel_product
     GROUP BY sel_product.product_name) AS counter
     WHERE counter.product_count > 1';

/**
 * Урок 47 - 10
 *  Товар, который может принадлежать нескольким категориям одновременно. Запросы:
Пользователь и его интересы (могут быть одинаковыми у разных пользователей). Запросы:
 * (1) достать интересы пользователя,
 * (2) достать всех пользователей с данным интересом.
 */

// (1)
$query = 'SELECT *, user.name AS user_name FROM user 
LEFT JOIN interest_rel ON interest_rel.user_id = user.id
LEFT JOIN interests ON interest_rel.interest_id = interests.id';

// (2)
$query = 'SELECT interests.name AS interest, user.name AS user_name FROM interests 
LEFT JOIN interest_rel ON interest_rel.interest_id = interests.id
LEFT JOIN user ON interest_rel.user_id = user.id
WHERE interests.name = \'Soccer\'';

/**
 * Урок 47 - 11
 *  Пользователь, товары, покупки пользователей. У товара есть цена, пользователь может купить не один экземпляр товара, а одновременно несколько. Запросы: 
 (1) вывести пользователей вместе с их покупками, 
 (2) вывести пользователей вместе с суммами всех их покупок, 
 (3) найти суммарные покупки на сайте за определенный месяц, 
 (4) найти суммарные покупки на сайте помесячно (то есть результат будет в таком виде: март 2010 — сумма1, апрель 2010 — сумма2, май 2010 — сумма3 и тд).
 */

// (1)
$query = 'SELECT user.name AS user_name, product.name AS product_name FROM user
LEFT JOIN purchase ON purchase.user_id = user.id
LEFT JOIN product ON purchase.product_id = product.id';

// (2)
$query = 'SELECT user.name AS user_name, SUM(product.price) AS all_price  FROM product 
LEFT JOIN purchase ON product.id = purchase.product_id LEFT JOIN user ON  purchase.user_id = user.id';


/**
 * Урок 47 - 12
 *  Есть отцы и сыновья. У отца может быть много сыновей. Запросы: 
 (1) получить всех сыновей пользователя, 
 (2) получить отца пользователя, 
 (3) получить дедушку пользователя, 
 (4) получить внуков пользователя. 
 */

 // (1)
$query = 'SELECT fathers.name AS father, f.name AS son FROM fathers
LEFT JOIN fathers AS f ON f.father_id = fathers.id';

 // (2)
$query = 'SELECT fathers.name AS father, users.name AS user FROM fathers
LEFT JOIN fathers AS users ON users.father_id = fathers.id
WHERE users.name IS NOT NULL';

// (3)
$query = 'SELECT users.name AS user, grandfa.name AS grandfa FROM fathers AS users
LEFT JOIN fathers AS fa ON users.father_id = fa.id
LEFT JOIN fathers AS grandfa ON fa.father_id = grandfa.id
WHERE grandfa.name IS NOT NULL';

// (4)
$query = 'SELECT users.name AS grandfather, grandsons.name AS grandson FROM fathers AS grandsons
LEFT JOIN fathers AS fa ON grandsons.father_id = fa.id
LEFT JOIN fathers AS users ON fa.father_id = users.id
WHERE grandsons.name IS NOT NULL AND users.name IS NOT NULL';




$data = make_query($link, $query);
?>

<pre>
    <?php
    var_dump($data);
    ?>
</pre>
