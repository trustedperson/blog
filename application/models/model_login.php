<?
class Model_Login extends Model {

	function validate($login, $password) {
		// reassignment
		$db = $this->db;
		// check: empty parameters?
		if ($login == '') unset($login);
		if ($password =='') unset($password);
		if (empty($login) or empty($password))
            {
                return "Вы ввели не всю информацию, заполните все поля!";
            }
        // check: user exists in db, and password is correct?
       	$db->escape($login);
       	$db->escape($password);
       	$user = $db->get_row("SELECT * from users where login='$login'");
       	if (($user->login == '') or ($password != $user->password))
	       	{
	       		return "Логин или пароль введён не верно";	
	       	}
	    // validation passed
	    if ($password == $user->password) 
	    	{
		    	$_SESSION['login']=$user->login; 
	            $_SESSION['id']=$user->id;
	            $_SESSION['email']=$user->email;
	            return "success";
	    	}
	    }
}