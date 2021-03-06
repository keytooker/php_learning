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
//$link = mysqli_connect($host, $user, $password, $db_name);

//Устанавливаем кодировку (не обязательно, но поможет избежать проблем):
//mysqli_query($link, "SET NAMES 'utf8'");

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
LEFT JOIN purchase ON product.id = purchase.product_id LEFT JOIN user ON  purchase.user_id = user.id
GROUP BY lesson47.user.name';

// (3)
$query = 'SELECT user.name AS user_name, SUM(product.price) AS all_price  FROM product 
LEFT JOIN purchase ON product.id = purchase.product_id LEFT JOIN user ON  purchase.user_id = user.id
WHERE MONTH(purchase.date) = 5
GROUP BY lesson47.user.name';

// (4)
$month = [3 => 'Март 2019', 4 => 'Апрель 2019', 5 => 'Май 2019'];
foreach ($month as $m => $name) {
	$query = 'SELECT purchase.date AS purchase_date, SUM(product.price) AS all_price  FROM product 
LEFT JOIN purchase ON product.id = purchase.product_id 
WHERE MONTH(purchase.date) = ' . $m . '
 GROUP BY lesson47.purchase.date';
	$data = make_query($link, $query);
	/* - вывод для 11 задачи, закомментил, чтобы он не мешал смотреть на дальнейший вывод
?>

<pre>
    <?php
    foreach ($data as $value) {
    	 //var_dump($value);
    	echo $name . ' - ' . $value['all_price'] . '; ';
    }
   
    ?>
</pre>
<?php
}
*/
}

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

/**
 * Урок 47 - 13
 *  Море, реки, притоки (притоки делятся на правые и левые). Реки могут быть притоками других рек или впадать прямо в море. Запросы: 
 (1) получить все реки Черного Моря, 
 (2) получить все реки Черного Моря вместе с притоками, 
 (3) получить все притоки реки Днепр, 
 (4) получить куда впадает данная река (в какую реку или в какое море). 
 */

 // (1)
$query = 'SELECT main_water.name AS main_name, inflow.name AS inflow  FROM water AS inflow 
LEFT JOIN water AS main_water ON inflow.flows_into = main_water.id
WHERE main_water.name = \'Black Sea\'';

// (2)
$query = 'SELECT sea.name AS main_name, inflow.name AS inflow, inflow2.name AS inflow_of_inflow  FROM water AS inflow 
LEFT JOIN water AS sea ON inflow.flows_into = sea.id
LEFT JOIN water AS inflow2 ON inflow2.flows_into = inflow.id
WHERE sea.name = \'Black Sea\'';

// (3)
$query = 'SELECT main_river.name AS main_river, inflow.name AS inflow FROM water AS inflow
 LEFT JOIN water AS main_river ON inflow.flows_into = main_river.id
 WHERE main_river.name = \'Dnieper river\'';

// (4)
 $query = 'SELECT main_river.name AS main_river, inflow.name AS inflow FROM water AS inflow
 LEFT JOIN water AS main_river ON inflow.flows_into = main_river.id
 WHERE inflow.name = \'Volga river\'';


/**
 * Урок 47 - 15
 Есть сайт с датами футбольных игр. В каждой игре нужно выводить дату игры, первую команду и вторую команду. После того, как игра прошла — нужно выводить еще и счет. Запросы: 
 (1) получить все игры вместе с командами, 
 (2) получить все игры с командами за текущий месяц, 
 (3) получить все игры с командами за предыдущий месяц, 
 (4) получить все сыгранные игры, 
 (5) получить все несыгранные игры.
 */

// (1)
 $query = 'SELECT team1.name AS team1, team2.name AS team2, `match`.score AS score FROM `match`
 LEFT JOIN  teams AS team1 ON `match`.`team1_id` = `team1`.`id`
 LEFT JOIN  teams AS team2 ON `match`.`team2_id` = `team2`.`id`';

 // (2)
 $query = 'SELECT team1.name AS team1, team2.name AS team2, `match`.score AS score, `match`.`date` AS match_date  FROM `match`
 LEFT JOIN  teams AS team1 ON `match`.`team1_id` = `team1`.`id`
 LEFT JOIN  teams AS team2 ON `match`.`team2_id` = `team2`.`id`
 WHERE MONTH(`match`.`date`) = MONTH(NOW())';

 // (3)
 $query = 'SELECT team1.name AS team1, team2.name AS team2, `match`.score AS score, `match`.`date` AS match_date  FROM `match`
 LEFT JOIN  teams AS team1 ON `match`.`team1_id` = `team1`.`id`
 LEFT JOIN  teams AS team2 ON `match`.`team2_id` = `team2`.`id`
 WHERE MONTH(`match`.`date`) = MONTH(NOW() - INTERVAL 1 MONTH)';

  // (4)
 $query = 'SELECT team1.name AS team1, team2.name AS team2, `match`.score AS score, `match`.`date` AS match_date  FROM `match`
 LEFT JOIN  teams AS team1 ON `match`.`team1_id` = `team1`.`id`
 LEFT JOIN  teams AS team2 ON `match`.`team2_id` = `team2`.`id`
 WHERE `match`.`date` > NOW()';

   // (5)
 $query = 'SELECT team1.name AS team1, team2.name AS team2, `match`.score AS score, `match`.`date` AS match_date  FROM `match`
 LEFT JOIN  teams AS team1 ON `match`.`team1_id` = `team1`.`id`
 LEFT JOIN  teams AS team2 ON `match`.`team2_id` = `team2`.`id`
 WHERE `match`.`date` < NOW()';

/**
* Урок 47 - 16
Модифицируем предыдущую задачу так, чтобы выводился также город, в котором будет игра. Каждая команда принадлежит своему городу (игра может быть в городе одной из команд). Добавьте еще и игроков, каждый игрок может принадлежать одной команде.
*/
$query = 'SELECT home_team.name AS home_team_name, road_team.name AS road_team_name, `match`.score AS score, city.name AS game_place, home_team_players.name AS home_players, road_team_players.name AS road_players FROM `match`
LEFT JOIN teams AS home_team ON `match`.`team1_id` = `home_team`.`id`
LEFT JOIN teams AS road_team ON `match`.`team2_id` = `road_team`.`id`
LEFT JOIN cities AS city ON `match`.`city_id` = `city`.`id`
LEFT JOIN players AS home_team_players ON home_team_players.team_id = home_team.id
LEFT JOIN players AS road_team_players ON road_team_players.team_id = road_team.id
';

/**
* Урок 47 - 17
Пользователь, страницы, категории страниц. Пользователи пишут посты в гостевой книге к определенной странице. Запросы: 
(1) получить все комментарии к данной странице, 
(2) получить все комментарии данного пользователя
*/

$query = 'SELECT comments.content AS comment, pages.title AS page_title FROM comments
LEFT JOIN pages ON comments.post_id = pages.id
WHERE pages.url = \'/soccer/game_last_week.php\'';

$query = 'SELECT user.name AS user_name, comments.content AS comment from user
 LEFT JOIN comments ON comments.user_id = user.id';

/**
* Урок 47 - 18
  Форум, категории, в них темы (тема принадлежит только одной категории), в темах посты. У темы есть автор. Пользователи могут обмениваться личными сообщениями. 
*/
$query = 'SELECT * FROM posts 
LEFT JOIN topic ON posts.topic_id = topic.id
LEFT JOIN forum_category ON topic.category_id = forum_category.id';

/**
* Урок 47 - 18
  Генеологическое дерево. Пользователь, его бабушки, дедушки, мама, папа, братья, сестры, дети. Можно найти любого родственника в любом колене (например, пра-пра-пра-дедушку). То есть есть пользователь, он может быть сыном, отцом, братом, дедушкой, прадедушкой и все это одновременно. Нужно хранить и получать родственные связи. Запросы: 
  (1) получить отца пользователя, 
  (2) получить мать пользователя, 
  (3) получить детей пользователя, 
  (4) получить сыновей пользователя, 
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

 $query = 'SELECT children.name AS user, parents.name AS dad FROM family_tree AS children
 LEFT JOIN family_tree AS parents ON children.father = parents.id
 WHERE children.name = \'Онопко Наталья\'';

$data = make_query($link, $query);
?>

<pre>
    <?php
    var_dump($data);
    ?>
</pre>