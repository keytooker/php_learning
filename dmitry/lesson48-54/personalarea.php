<?php
/**
 * personalarea.php
 *
 * Урок 54
 * Задача 4
 * Реализовать личный кабинет.
 */
session_start();

// доступ к странице personalArea.php может иметь только авторизованный пользователь
if ( isset($_SESSION['auth']) and ($_SESSION['auth'] === true) )
{
    $id = $_SESSION['id'];

    $host = 'localhost'; //имя хоста, на локальном компьютере это localhost
    $user = 'root'; //имя пользователя, по умолчанию это root
    $password = ''; //пароль, по умолчанию пустой
    $db_name = '48-55'; //имя базы данных

    //Соединяемся с базой данных используя наши доступы:
    $link = mysqli_connect($host, $user, $password, $db_name);
    mysqli_query($link, "SET NAMES 'utf8'");


    // Если пользователь что-то ввел в форму и применил изменения
    if ( !empty($_POST) )
    {

        $name = $_POST['name'];
        $patronymic = $_POST['patronymic'];
        $surname = $_POST['surname'];
        $rawdate = htmlentities($_POST['date']);
        $date = date('Y-m-d', strtotime($rawdate));

        $query = 'UPDATE users SET name = \'' . $name . '\', patronymic = \'' . $patronymic . '\', surname = \'' .
            $surname . '\', date=\'' . $date . '\', country=\'' . $_POST['country'] . '\' WHERE id=' . $id;
        mysqli_query($link, $query);
    }

    // Пробуем получить юзера с таким логином:
    $query = 'SELECT * FROM users WHERE id=\'' .$id . '\'';
    $user = mysqli_fetch_assoc(mysqli_query($link, $query));

    // Если юзера с таким логином нет:
    if ( !empty($user) ) {
        ?>
        <form action="" method="POST">
            <p>
                Логин:
                <?php echo $user['login'];
                ?>
            </p>

            <p>
                Имя: <input name="name" value="<?= $user['name'] ?>">
            </p>
            <p>
                Отчество: <input name="patronymic" value="<?= $user['patronymic'] ?>">
            </p>
            <p>
                Фамилия: <input name="surname" value="<?= $user['surname'] ?>">
            </p>

            <p>
                Дата рождения: <input type="date" name="date"  value="<?php echo $user['date']; ?>"/>
            </p>
            <p>
                country:
                <?php
                $countries = array(
                'Russia' => 'Russia',
                'Belarus' => 'Belarus',
                    'USA' => 'USA',
                );
?>
                <select name="country">
                    <?php foreach( $countries as $var => $country ): ?>
                        <option value="<?php echo $var ?>"<?php if( $var == $user['country'] ): ?> selected="selected"<?php endif; ?>>
                            <?php echo $country ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </p>
            <p>
                <input type="submit" value="Отправить">
            </p>
        </form>
        <?php
    }
    else {
        echo 'Пользователь с id = ' . $id . ' не найден.';
    }

}