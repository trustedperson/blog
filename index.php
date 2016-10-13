<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/png" href="https://alotof.work/favicon.png">
    <link rel="stylesheet" type="text/css" href="css/index.css">
	<script src="https://use.fontawesome.com/7e24d392b6.js"></script>
	<script src="/js/main.js"></script>
    <meta charset="UTF-8">
    <title>alotof.work</title>
    
</head>
<?
    session_start();   
    include('include/session_lifetime.php');
?>
<body>
    <div class="top_right_panel">
            <?php
            if(empty($_SESSION['id']) or empty($_SESSION['login'])) {
                echo '<a class="top_right_panel_button" href="login.php">Login page</a>';
                echo '<a class="top_right_panel_button" href="reg.php">Sign UP</a>';
            }

            ?>
    </div>
    <img class="pointer" src="https://alotof.work/chicken.gif">
    <img id="avatar" src="https://alotof.work/avatar2.png">
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

    include_once "include/ez_sql_core.php";

    // Include ezSQL database specific component
    include_once "include/ez_sql_mysql.php";
    include_once "../conf";

    // Initialise database object and establish a connection
    // at the same time - db_user / db_password / db_name / db_host
    // $db = new ezSQL_mysql($db_user,$db_password,$db_name,$db_host);

    // $var2 = $db->get_results("SELECT user_login, user_email, meta_value AS 'last name' FROM wp1_users AS u, wp1_usermeta AS m WHERE meta_key='last_name' AND u.ID=m.user_id");
    // $db->debug();

    ?>
</body>
</html>
