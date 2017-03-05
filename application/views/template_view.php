<!DOCTYPE html>
<html lang="ru">
<head>
    <base href="https://alotof.work/">
    <link rel="icon" type="image/png" href="https://alotof.work/images/favicon.png">
    <link rel="stylesheet" type="text/css" href="css/template.css">
	<script src="/js/template.js"></script>
    <meta charset="UTF-8">
    <title>alotof.work</title>
</head>
<body>
    <?
    if (has_login())
        {
            include "../application/views/parts/admin_panel.php";    
        }
    ?>
<div id="navi">
    <a href="/" class="navi_btn"> Главная </a>
    <a href="/blog" class="navi_btn"> Блог </a>
    <a href="/about" class="navi_btn"> Контакты </a>
</div>

<div id="content">
    <?php include '../application/views/'.$content_view; ?>
</div>
</body>
</html>