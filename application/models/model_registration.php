<?
class Model_Registration extends Model {
	
	function validateInputAndWrite() {
		// reassignment
		$db = $this->db;
		// check: empty parameters?
		if (empty($_POST['password']) or empty($_POST['email'])) 
			{
				return "Вы ввели не всю информацию, заполните все поля!";
			}
			else
				{
					$email = $_POST['email'];
					$password = $_POST['password'];
				}
		// check: lenght is correct?
		if (strlen($password) > 30 or strlen($email) > 30)	
			{
				return "Emal или пароль слишком длинный! Не более 30 символов";
			}
		if (strlen($password) < 8 or strlen($email) < 8)
			{
				return "Email или пароль слишком короткий! Не менее 8 символов.";
			}
		// check: special symbols?
       	$db->escape($email);
       	$db->escape($password);
       	// check: user already exists?
       	$result = $db->get_row("SELECT * from users WHERE email='$email'");
       	if (!empty($result)) 
	       	{
	       		return "Такой пользователь уже зарегистрирован!";
	       	}
	       	// put data into db
	       	else
		       	{
					$db->query("INSERT INTO users (email, password) VALUES('$email', '$password')");
					if ($db->rows_affected != 1) return "Что-то пошло не так...";
					$_SESSION['registration_msg'] = "Регистрация успешно завершена!";
					return "success";		       		
		       	}

	}
}