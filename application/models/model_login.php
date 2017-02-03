<?
class Model_Login extends Model {

	function validateLoginAndCreateSession() {
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

		// check: google reCAPTCHA
	    $captcha_resp = $_POST['g-recaptcha-response'];
	    $post_data = array('secret' => $GLOBALS["captcha_secret"], 'response' => $captcha_resp);
	    $response = httpPost('https://www.google.com/recaptcha/api/siteverify',$post_data);
	    $resp_array = json_decode($response,true);
	    if (!$resp_array["success"]) 
		    {
		    	return "Вы не прошли капчу google!";
		    }
		// get data
		$sql = "SELECT * from users WHERE email = :email";
       	$stmt = $this->pdo->prepare($sql);
       	$stmt->bindValue(":email", $email);
       	$stmt->execute();
       	$row = $stmt->fetch();
        // check: user exists in db, and password is correct?
       	if (empty($row['email']) or (!password_verify($password, $row['password'])))
	       	{
	       		return "Email или пароль введён не верно";	
	       	}
	    // validation passed
        $_SESSION['id']=$row['id'];
	    $_SESSION['email']=$row['email'];
	    $_SESSION['first_name']=$row['first_name'];
	    $_SESSION['last_name']=$row['last_name'];
        return "success";
	    // if something wrong
	    return "Что-то пошло не так...";
	    }
}