<!DOCTYPE html>
<html lang="en">
<head>
    <base href="https://alotof.work/">
    <link rel="icon" type="image/png" href="https://alotof.work/images/favicon.png">
    <link rel="stylesheet" type="text/css" href="css/index.css">
	<!-- <script src="https://use.fontawesome.com/7e24d392b6.js"></script> -->
	<script src="/js/main.js"></script>
    <meta charset="UTF-8">
    <title>alotof.work</title>
</head>
<body>
<div class="top_right_panel">
    <?
    if(!session_exists())
        {
            echo '<a class="top_right_panel_button" href="login">Login</a>';
            echo '<a class="top_right_panel_button" href="registration">Sign Up</a>';
        }
    if (session_exists())
        {
            echo "Вы вошли как<br>".$_SESSION['first_name']." ".$_SESSION['last_name']."!"."<br><a href='profile'>Мой профиль</a><br><form><button formaction='login/exit/'> Выход</button></form>";
        }
    ?>
</div>
<img class="pointer" src="https://alotof.work/images/chicken.gif">
<div class="sidebar">
    <div class="sidebar_navi">
            <!-- <a href="/main" class="sidebar_navi_btn">
                Главная {..<span class="curly_brace">}</span>
            </a>  -->
            <a href="/blog" class="sidebar_navi_btn">
                Блог {..<span class="curly_brace">}</span>
            </a> 
            <a href="/about" class="sidebar_navi_btn">
                Контакты {..<span class="curly_brace">}</span>
            </a> 
    </div>
    <div class="tooltip">
        <div class="tooltip_text">
            hi this is tooltip
        </div>
    </div>
</div>

<div class="main">
    <div class="wrap_slider">
        <ul class="slider">
            <li class="slider_panel">
                <img width="600" height="200" src="images/back.jpg">
            </li>
            <li class="slider_panel">
                <img width="600" height="200" src="images/avatar.png">
            </li>
            <li class="slider_panel">
                <img width="600" height="200" src="images/avatar.png">
            </li>
            <li class="slider_panel">
                <img width="600" height="200" src="images/avatar.png">
            </li>
            <li class="slider_panel">
                <img width="600" height="200" src="images/avatar.png">
            </li>
            <li class="slider_panel">
                <img width="600" height="200" src="images/back_rotated.jpg">
            </li>
        </ul>
        <div class="slider_controls_left">
            LEFT
        </div>
        <div class="slider_controls_right">
            RIGHT
        </div>
    </div>
    <div class="content">
        <?php include 'application/views/'.$content_view; ?>
    </div>
</div>
</body>
</html>