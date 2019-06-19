<?php
/**
 * logout.php
 */

session_start();
$_SESSION['auth'] = false;

header('Location: /dmitry/lesson48-50/index.php');