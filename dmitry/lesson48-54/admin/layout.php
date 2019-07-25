<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css?v=1">
    <title><?php echo $title; ?></title>
</head>
<body>
<header>
    <a href="/admin/add.php">Добавить новую</a>
</header>
<main>
    <?php
    include 'elem/info.php';
    echo $content;
    ?>
</main>

<footer>
    footer
</footer>

</body>
</html>