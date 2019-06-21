<?php
$p = include('password.php');
session_start();
if ( $_SESSION['auth'] )
{
include __DIR__ . '/../elems/init.php';
$table_name = 'pages';

function get_form()
{
    $title = 'admin add page';

    $form_send = isset($_POST['title']) and isset($_POST['url']) and isset($_POST['text']);
    if ( $form_send ) {
        $title = $_POST['title'];
        $url = $_POST['url'];
        $text = $_POST['text'];
    }
    else
    {
        $title = '';
        $url = '';
        $text = '';
    }

    ob_start();
    include 'elem/form.php';
    $content = ob_get_clean();

    include 'layout.php';
}

function add_page($link, $table_name)
{
    $form_send = isset($_POST['title']) and isset($_POST['url']) and isset($_POST['text']);
    if ( $form_send )
    {
        $title = mysqli_real_escape_string( $link, $_POST['title'] );
        $url = mysqli_real_escape_string( $link, $_POST['url'] );
        $text = mysqli_real_escape_string( $link, $_POST['text'] );


        $query = 'SELECT COUNT(*) as count FROM ' . $table_name . ' WHERE url = \'' . $url . '\'';

        $result = mysqli_query($link, $query) or die( mysqli_error($link) );
        $there_is = mysqli_fetch_assoc($result)['count'];

        if ($there_is > 0)
        {
            $_SESSION['message'] = [ 'text' => 'Страница уже существует!', 'status' => 'error'];
        }
        else
        {
            $query = 'INSERT INTO ' . $table_name . ' (title, url, text) VALUES (\'' . $title . '\', \'' . $url . '\', \'' . $text . '\')';
            mysqli_query($link, $query) or die( mysqli_error($link) );

            $_SESSION['message'] = [ 'text' => 'Страница добавлена', 'status' => 'success'];

            header('Location: /admin/');
        }
    }
}

add_page($link, $table_name);
get_form();
}
else
{
    header('Location: /admin/login.php');
}



