<!DOCTYPE html>
<html lang="ru">
<head>
    <base href="https://alotof.work/">
    <link rel="icon" type="image/png" href="https://alotof.work/images/favicon.png">
    <link rel="stylesheet" type="text/css" href="css/template.css">
    <link rel="stylesheet" type="text/css" href=<?echo '"css/'.Route::$routes[1].'.css"';?>>
	<script src="/js/template.js"></script>
    <meta charset="UTF-8">
    <title>alotof.work</title>
</head>
<body>
    <?
    if (has_login())
        {
            echo "<div class='top_right_panel'>Вы вошли как<br>".$_SESSION['first_name']." ".$_SESSION['last_name']."!<br>";
            echo "<a href='profile'>Мой профиль</a><br>";
            echo "<a href='profile/moderation'>Модерация</a><br><br>";
            echo "<form><button formaction='login/exit/'> Выход</button></form></div>";
        }
    ?>
<div class="sidebar">
    <div class="sidebar_navi">
            <a href="/blog" class="sidebar_navi_btn">
                Блог
            </a> 
            <a href="/about" class="sidebar_navi_btn">
                Контакты
            </a> 
    </div>
</div>

<div class="main">
    <div class="content">
        <?php include 'application/views/'.$content_view; ?>
    </div>
</div>
</body>
</html>