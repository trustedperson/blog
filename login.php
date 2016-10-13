<?php 
session_start();
include('include/session_lifetime.php');
$loginResult = include ("include/try_login.php");
if(!empty($_SESSION['id']) or !empty($_SESSION['login'])) {
    header('Location: http://alotof.work/');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/png" href="https://alotof.work/favicon.png">
    <link rel="stylesheet" type="text/css" href="css/sign_forms.css">
    <script src="https://use.fontawesome.com/7e24d392b6.js"></script>
    <meta charset="UTF-8">
    <title>DEV</title>
</head>
<body>

    <form class="login_form" action="login.php" method="post">
            <input name="action" value="login" type="hidden" size="15" maxlength="15">
        <span>
            <label>login:<br></label>
            <input name="login" type="text" size="15" maxlength="15">
        </span>
        <br>
        <span>
            <label>password:<br></label>
            <input name="password" type="password" size="15" maxlength="15">
        </span>
        <br>

        <button type="submit"><i class="fa fa-sign-in" aria-hidden="true"></i> Вход</button>  

    </form>
    
<?php echo $loginResult ?>
</body>
</html>