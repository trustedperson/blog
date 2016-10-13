<?php 
session_start();
include('include/session_lifetime.php');
$regResult = include ("include/try_reg.php");
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
    <form class="reg_form" action="reg.php" method="post">
        <input name="action" value="reg" type="hidden" size="15" maxlength="15">
        <span>
            <label>email:<br></label>
            <input name="email" type="text" size="20" maxlength="30">
        </span>
        <br>
        <span>
            <label>login:<br></label>
            <input name="login" type="text" size="15" maxlength="15">
        </span>
        <br>
        <!--**** В текстовое поле (name="login" type="text") пользователь вводит свой логин ***** -->
        <span>
            <label>password:<br></label>
            <input name="password" type="password" size="15" maxlength="15">
        </span><br>
        <!--**** В поле для паролей (name="password" type="password") пользователь вводит свой пароль ***** --> 
        <span>
            <button type="submit"><i class="fa fa-male" aria-hidden="true"></i> Зарегистрироваться!</button>
            <!--**** Кнопочка (type="submit") отправляет данные на страничку save_user.php ***** --> 
        </span>
    </form>
    <?php echo $regResult ?>
</body>
</html>