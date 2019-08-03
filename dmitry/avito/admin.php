<?php
/**
 * admin.php
 * Список объявлений авторизованного пользователя.
 * Возможность поднять объявление раз в сутки.
 * Добавление объявления в базу при переходе с ads.php
 */

include __DIR__ . '/elems/init.php';
session_start();

?>

<p><a href="/dmitry/avito/">На главную</a></p><p>

<?php
$current_user = $_SESSION['login'];
echo 'Вы вошли как ' . $current_user . '</p>';
if ( isset($_SESSION['auth']) )
{
//Соединяемся с базой данных используя наши доступы:
    $link = mysqli_connect($host, $user, $password, $db_name);


    // ВЫтаскиваю id текущего пользователя
    $query = 'SELECT id AS user_id FROM users WHERE login = \'' . $_SESSION['login'] . '\'';
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    $user_id = mysqli_fetch_assoc($result)['user_id'];

    // Если было добавлено объявление
    if ( isset($_POST['title']) and isset($_POST['ad']) )
    {


        $query = 'SELECT id AS ctg_id FROM category WHERE id = ' . $_SESSION['categoryid'];

        $result = mysqli_query($link, $query) or die(mysqli_error($link));
        $ctg_id = mysqli_fetch_assoc($result)['category'];

        $query = 'INSERT INTO ads SET title=\'' . $_POST['title'] . '\', text=\'' . $_POST['ad'] . '\',
            timeup = NOW(), user = \'' . $user_id . '\', category = ' . $_SESSION['categoryid'];

        $result = mysqli_query($link, $query);

        if ( $result !== true )
        {
            unset($_SESSION['categoryid']);
        }
    }

    // Если пользователь решил поднять объявление в поиске
    if ( isset($_GET['action']) and isset($_GET['id']) )
    {

        $query = 'UPDATE ads SET timeup = now() WHERE id = ' . $_GET['id'];

        mysqli_query($link, $query);
    }

    $query = 'SELECT * FROM ads WHERE user = ' . $user_id;

//Делаем запрос к БД, результат запроса пишем в $result:
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
//Преобразуем то, что отдала нам база в нормальный массив PHP $data:
    for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row) ;

    ?>
    <pre>
<table>
<?php
if (empty($data))
{
    ?>
    <p>У вас нет активных объявлений</p>
    <?php
}

foreach ($data as $record) {
    ?>
    <tr class="note">
        <td>
            <span class="date">
                    <?php
                    $up_date = date_create($record['timeup']);
                    echo date_format($up_date, "Y/m/d H:i:s");
                    //echo(date("Y-m-d", $record['time']));
                    ?></span>
            <span class="name"><?php
                echo $record['author'];
                ?></span>
        </td>
        <td>
            <?php
            echo $record['text'];
            ?>
        </td>
        <td>
            <?php
            $thisdate = new DateTime();
            $interval = $thisdate->diff($up_date);

            // Если поднимали более суток назад, разрешаем поднять
            if($interval->days != 0) {

                ?>
                <a href="/dmitry/avito/admin.php?action=up&id=<?= $record['id']; ?>">Поднять</a>
                <?php

            }

            ?>

        </td>

    </tr>
    <?php
}
?>
</table>
    </pre>

    <?php
} // ~ if ( isset($_SESSION['auth']) )