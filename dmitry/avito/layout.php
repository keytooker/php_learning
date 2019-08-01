<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="admin/style.css?v=5">
    <title><?php echo $title; ?></title>
</head>
<body>
<header>
    <?php include 'elems/header.php'; ?>
</header>
<main>
    <?php
    echo $content;
    ?>
</main>

<footer>
    Урок 56. Доска объявлений
</footer>

</body>
</html>