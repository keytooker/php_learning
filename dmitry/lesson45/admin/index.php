<?php
session_start();
$p = include('password.php');

if ( $_SESSION['auth'] )
{
    include __DIR__ . '/../elems/init.php';
    $table_name = 'pages';

    function show_page_table($link, $table_name)
    {
        $query = 'SELECT id, title, url FROM ' . $table_name . ' WHERE url != 404';
        $result = mysqli_query($link, $query) or die(mysqli_error($link));
        for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row) ;

        $content = '<table><tr><th>title</th><th>url</th><th>edit</th><th>delete</th></tr>';

        foreach ($data as $record) {
            $content = $content . '<tr>
        <td>' . $record['title'] . '</td>
        <td>' . $record['url'] . '</td>
        <td><a href="/admin/edit.php?id=' . $record['id'] . '">edit</a></td>
        <td><a href="?delete=' . $record['id'] . '">delete</a></td>
    </tr>';
        }
        $content = $content . '</table>';

        $title = 'admin main page';

        include 'layout.php';
    }

    function delete_page($link, $table_name)
    {
        if (isset($_GET['delete'])) {
            $query = 'DELETE FROM ' . $table_name . ' WHERE id = ' . $_GET['delete'];
            $result = mysqli_query($link, $query) or die(mysqli_error($link));

            $_SESSION['message'] = ['text' => 'Страница ' . $_GET['delete'] . ' удалена', 'status' => 'success'];

            header('Location: /admin/');
            die();
        }
    }

    delete_page($link, $table_name);
    show_page_table($link, $table_name);
}
else
{
    header('Location: /admin/login.php');
}





