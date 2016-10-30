<?
class Model_Login extends Model {

	function validateLoginAndLogIn() {
		// reassignment
		$db = $this->db;
		// check: empty parameters?
		if (empty($_POST['email']) or empty($_POST['password'])) 
			{
				return "Вы ввели не всю информацию, заполните все поля!";
			}
			else
				{
					$email = $_POST['email'];
					$password = $_POST['password'];
				}
		// check: lenght is correct?
		if (strlen($email) > 30 or strlen($password) > 30)	
			{
				return "Пароль или email слишком длинный!";
			}
		if (strlen($email) < 8 or strlen($password) < 8)
			{
				return "Пароль или email слишком короткий!";
			}
		// check: special symbols?
       	$db->escape($email);
       	$db->escape($password);
        // check: user exists in db, and password is correct?
       	$user = $db->get_row("SELECT * from users WHERE email='$email'");
       	if (empty($user->email) or ($password != $user->password))
	       	{
	       		return "Email или пароль введён не верно";	
	       	}
	    // validation passed
	    if ($password == $user->password) 
	    	{
	            $_SESSION['id']=$user->id;
	            $_SESSION['email']=$user->email;
	            return "success";
	    	}
	    }
}