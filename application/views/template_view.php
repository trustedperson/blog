<!DOCTYPE html>
<html lang="ru">
<head>
    <base href="https://alotof.work/">
    <link rel="icon" type="image/png" href="https://alotof.work/images/favicon.png">
    <link rel="stylesheet" type="text/css" href="css/template.css">
    <link rel="stylesheet" href="resources/font-awesome-4.7.0/css/font-awesome.min.css">
    <script src="/js/main.js"></script>
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-93180231-1', 'auto');
      ga('send', 'pageview');

    </script>
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