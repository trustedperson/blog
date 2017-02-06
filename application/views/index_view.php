<!DOCTYPE html>
<html lang="en">
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
        <video id="video" width="400" autoplay muted loop>
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
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque mattis lacus cursus, tempor urna id, laoreet orci. Fusce vitae arcu velit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Morbi non nunc sagittis, dictum risus vitae, finibus nulla. Ut eu orci sed lectus facilisis auctor et eu nunc. Mauris varius velit dui, sed fringilla diam ornare non. Curabitur pellentesque interdum risus et lacinia. Pellentesque diam ipsum, venenatis eu libero quis, interdum fringilla nunc. Duis in neque nisl. Duis tempor sed magna quis malesuada. Proin at velit ac neque ornare iaculis quis non enim. Nullam nec varius nisi. Vestibulum condimentum sapien turpis, consequat posuere magna feugiat vitae.
        </div> 
        <div class="back_shadow">
        </div>
        <i class="fa fa-vcard fa-4x text_trigger" onmouseover="showText()" onmouseleave="closeText()" aria-hidden="true"></i>
    </body>
</html>