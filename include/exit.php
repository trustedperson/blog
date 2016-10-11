<?php
session_start();
unset($_SESSION['login']);
unset($_SESSION['id']);
if (empty($_SESSION['login']) or empty($_SESSION['id'])) {
	header('Location: http://demo.qweekdev.com/');
    exit;
}
else echo "<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <title></title>
</head>
<body>Произошла ошибка
</body>
</html>";
?>
