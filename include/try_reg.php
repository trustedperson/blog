<?php
if($_POST['action']=='reg') {
        if (isset($_POST['login'])) { $login = $_POST['login']; if ($login == '') { unset($login);} } //заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную
        if (isset($_POST['password'])) { $password=$_POST['password']; if ($password =='') { unset($password);} }
        //заносим введенный пользователем пароль в переменную $password, если он пустой, то уничтожаем переменную
        if (isset($_POST['email'])) { $email = $_POST['email']; if ($email == '') { unset($email);} }
        if (empty($login) or empty($password) or empty($email)) //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
        {
        return "Вы ввели не всю информацию, вернитесь назад и заполните все поля!";
        }
        //если логин и пароль введены, то обрабатываем их, чтобы теги и скрипты не работали, мало ли что люди могут ввести
        $login = stripslashes($login);
        $login = htmlspecialchars($login);
        $password = stripslashes($password);
        $password = htmlspecialchars($password);
     //удаляем лишние пробелы
        $login = trim($login);
        $password = trim($password);
     // подключаемся к базе
        include ("db.php");// файл bd.php должен быть в той же папке, что и все остальные, если это не так, то просто измените путь 
     // проверка на существование пользователя с таким же логином
        $result = mysql_query("SELECT id FROM users WHERE login='$login'",$db);
        $myrow = mysql_fetch_array($result);
        if (!empty($myrow['id'])) {
        return "Извините, введённый вами логин уже зарегистрирован. Введите другой логин.";
        }
     // если такого нет, то сохраняем данные
        $result2 = mysql_query ("INSERT INTO users (login,password,email) VALUES('$login','$password','$email')");
        // Проверяем, есть ли ошибки
        if ($result2=='TRUE')
        {
        $_SESSION['reg_msg'] = "Вы успешно зарегистрированы!";
        header('Location: http://demo.qweekdev.com/');
        exit;
        }
        else {
        return "Ошибка! Вы не зарегистрированы.";
        }
} else return;
?>