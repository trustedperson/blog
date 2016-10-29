<div class="top_right_panel">
            <?php
            if(empty($_SESSION['id']) or empty($_SESSION['login'])) {
                echo '<a class="top_right_panel_button" href="login">Login page</a>';
                echo '<a class="top_right_panel_button" href="register">Sign UP</a>';
            }

            ?>
    </div>
    <img class="pointer" src="https://alotof.work/images/chicken.gif">
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
    <div class="tooltip">
        <div class="tooltip_text">hi this is tooltip
        </div>
    </div>
    <div class="content">
        <a class="content_button" href="https://alotof.work/wp/" data-section="wordpress" target="_blank">Wordpress</a>
        <a class="content_button" href="" data-section="todo" target="_blank">"todo list" service</a>
    </div>
    <?php if(isset($_SESSION['reg_msg'])) {echo $_SESSION['reg_msg']; unset($_SESSION['reg_msg']);} ?>

    <?php
    if (empty($_SESSION['login']) or empty($_SESSION['id']))
    {

    }
    else
    {
        echo "Вы вошли на сайт, как ".$_SESSION['login']."<br><form><button formaction='include/exit.php'><i class='fa fa-sign-out' aria-hidden='true'></i> Выход</button></form>";
    }
    ?>