<?php
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
                Возраст: <?php
                echo ( floor((time() - strtotime($user['date'])) / 31556926) );
                ?>
            </p>

            <p>
                Дата рождения: <input type="date" name="date"/> <?php
                echo ( floor((time() - strtotime($user['date'])) / 31556926) );
                ?>
            </p>
            <p>
                country:
                <select name="country">
                    <option value="seo"<?php if($result['interest'] == 'seo'): ?> selected="selected"<?php endif; ?>>SEO и Блоговодство</option>
                    <option value="Russia">Russia</option>
                    <option value="Ukraine">Ukraine</option>
                    <option value="Belarus">Belarus</option>
                    <option value="USA">USA</option>
                    <option value="Gonduras">Gonduras</option>
                </select>
            </p>
            <p>
                <?php
                $countries = array(
                'seo' => 'Russia',
                'auto' => 'Belarus',
                );
?>
                <select name="interest">
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