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
		// check: special symbols?
       	$email = $db->escape($email);
       	$password = $db->escape($password);
       	$email = trim($email);
       	$password = trim($password);
		// check: lenght is correct?
		if (strlen($password) > 30 or strlen($email) > 30)	
			{
				return "Emal или пароль слишком длинный! Не более 30 символов";
			}
		if (strlen($password) < 8 or strlen($email) < 8)
			{
				return "Email или пароль слишком короткий! Не менее 8 символов.";
			}
       	// check: user already exists?
       	$result = $db->get_row("SELECT * from users WHERE email='$email'");
       	if (!empty($result)) 
	       	{
	       		return "Такой пользователь уже зарегистрирован!";
	       	}
	    // check: google reCAPTCHA
	    $captcha_resp = $_POST['g-recaptcha-response'];
	    $post_data = array('secret' => $GLOBALS["captcha_secret"], 'response' => $captcha_resp);
	    $response = httpPost('https://www.google.com/recaptcha/api/siteverify',$post_data);
	    $resp_array = json_decode($response,true);
	    if (!$resp_array["success"]) 
	    {
	    	return "Вы не прошли капчу google!";
	    }
       	// put data into db
		$db->query("INSERT INTO users (email, password) VALUES('$email', '$password')");
		// if no rows affected...
		if ($db->rows_affected != 1) return "Что-то пошло не так...";
		$_SESSION['registration_msg'] = "Регистрация успешно завершена!";
		return "success";		       		

	}
}