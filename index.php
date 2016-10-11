<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/png" href="https://demo.qweekdev.com/favicon.png">
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
    <img class="pointer" src="https://alotof.work/chicken.gif">
    <div class="top_right_panel">
            <?php
            if(empty($_SESSION['id']) or empty($_SESSION['login'])) {
                echo '<div class="btn_wrap"><a class="point_button" href="login.php">Login page</a></div>';
                echo '<div class="btn_wrap"><a class="point_button" href="reg.php">Sign UP</a></div>';
            }

            ?>
    </div>
    <div class="content">
        <img id="avatar" src="https://demo.qweekdev.com/avatar.png">
        <div class="btn_wrap"><a class="point_button" href="https://demo.qweekdev.com/wp/" target="_blank">Wordpress</a></div>
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
    $db = new ezSQL_mysql($db_user,$db_password,$db_name,$db_host);

    /**********************************************************************
    *  ezSQL demo for mySQL database
    */

    // Demo of getting a single variable from the db
    // (and using abstracted function sysdate)
    $current_time = $db->get_var("SELECT " . $db->sysdate());
    print "ezSQL demo for mySQL database run @ $current_time";

    // Print out last query and results..
    $db->debug();
    ?>
</body>
</html>
