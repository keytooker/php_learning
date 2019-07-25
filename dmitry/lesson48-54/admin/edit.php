<?php
$p = include('password.php');
session_start();
if ( $_SESSION['auth'] )
{
include __DIR__ . '/../elems/init.php';
$table_name = 'pages';

function get_form($link, $table_name)
{
    $title = 'admin edit page';

    if ( !isset($_GET['id']))
    {
        $content = 'Страница не найдена';
        include 'layout.php';
        return '';
    }

    $id = $_GET['id'];
    $query = 'SELECT * FROM ' . $table_name . ' WHERE id = ' . $id;

    $result = mysqli_query($link, $query) or die( mysqli_error($link) );
    $page = mysqli_fetch_assoc($result);

    if ($page != null) {
        $page_exists = true;
        $form_send = isset($_POST['title']) and isset($_POST['url']) and isset($_POST['text']);
        if ( $form_send ) {
            $title = $_POST['title'];
            $url = $_POST['url'];
            $text = $_POST['text'];

            $page_exists = true;
        }
        else {
            $title = $page['title'];
            $url = $page['url'];
            $text = $page['text'];
        }

        ob_start();
        include 'elem/form.php';
        $content = ob_get_clean();
    }
    else
    {
        $content = 'Страница не найдена';
    }
    include 'layout.php';
}

function add_page($link, $table_name)
{
    $form_send = isset($_POST['title']) and isset($_POST['url']) and isset($_POST['text']);
    if ( $form_send )
    {
        $title = $_POST['title'];
        $url = $_POST['url'];
        $text = $_POST['text'];


        if ( isset($_GET['id']) ) {
            $id = $_GET['id'];

            $query = 'SELECT * FROM ' . $table_name . ' WHERE id = ' . $id;

            $result = mysqli_query($link, $query) or die( mysqli_error($link) );
            $page = mysqli_fetch_assoc($result);
            if ($page['url'] !== $url)
            {
                $query = 'SELECT COUNT(*) as count FROM ' . $table_name . ' WHERE url = \'' . $url . '\'';

                $result = mysqli_query($link, $query) or die( mysqli_error($link) );
                $there_is = mysqli_fetch_assoc($result)['count'];

                if ($there_is > 0 )
                {
                    $_SESSION['message'] = [ 'text' => 'Страница уже существует!', 'status' => 'error'];
                }
            }

            $query = 'UPDATE ' . $table_name . ' SET title=\'' . $title . '\', url=\'' . $url . '\', text=\'' . $text . '\' WHERE id=' . $id;
            mysqli_query($link, $query) or die(mysqli_error($link));
            $_SESSION['message'] = ['text' => 'Страница ' . $page['title'] . ' отредактирована', 'status' => 'success'];

            header('Location: /admin/');
            die();
        }
    }
    else
    {
        return '';
    }
}

add_page($link, $table_name);
get_form($link, $table_name);
}
else
{
    header('Location: /admin/login.php');
}





