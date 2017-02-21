<!DOCTYPE html>
<html lang="ru">
    <head>
        <base href="https://alotof.work/">
        <link rel="icon" type="image/png" href="https://alotof.work/images/favicon.png">
        <link rel="stylesheet" type="text/css" href="css/index.css">
    	<link rel="stylesheet" href="resources/font-awesome-4.7.0/css/font-awesome.min.css">
    	<script src="/js/main.js"></script>
        <meta charset="UTF-8">
        <title>alotof.work</title>
    </head>
    <body>
        <video id="video" autoplay muted loop>
          <?echo "<source src='resources/" . rand(1,4) . ".mp4' type='video/mp4'>"?>
          Your browser does not support HTML5 video.
        </video>
        <i id="pause" onclick="play()" class="fa fa-pause fa-3x" aria-hidden="true"></i>
        
        <div class="bar">

            <a class="link" href="blog">
                <i class="fa fa-file-text fa-3x fa-fw bar_icon" aria-hidden="true"></i>
                
            </a>
            <div class="tooltip">Blog</div>
            <a class="link" href="about">
                <i class="fa fa-user fa-3x fa-fw bar_icon" aria-hidden="true"></i>
                
            </a>
            <div class="tooltip">me</div>
        </div>
        <div class="text">
            <p> Блог Александра Макаренкова </p>
            <p> "О жизни в Петербурге и об IT."<br> </p>
            В этом блоге я веду записи относительно своей деятельности и происходящих вокруг меня событий, а также просто записываю интересные моменты по разработке.
                Любые мнения и комментарии приветствуются!<br> Feel free.                
        </div> 
        <div class="back_shadow">
        </div>
        <i class="fa fa-vcard fa-4x text_trigger" onmouseover="showText()" onmouseleave="closeText()" aria-hidden="true"></i>
    </body>
</html>