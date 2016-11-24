<?
class Model_Registration extends Model
{
	
	function validateInputAndInsert()
	{
		// check: empty parameters?
		if (empty($_POST['password']) or empty($_POST['email']) or empty($_POST['first_name']) or empty($_POST['last_name'])) 
			{
				return "Вы ввели не всю информацию!";
			}
		else
			{
				$email = $_POST['email'];
				$password = $_POST['password'];
				$first_name = $_POST['first_name'];
				$last_name = $_POST['last_name'];
			}
		// check: special symbols?
       	
		// check: lenght is correct?
		if (strlen($password) > 30 or strlen($email) > 30)	
			{
				return "Emal или пароль слишком длинный! Не более 30 символов";
			}
		if (strlen($password) < 8 or strlen($email) < 8)
			{
				return "Email или пароль слишком короткий! Не менее 8 символов.";
			}
       	if (strlen($first_name) > 50 or strlen($last_name) > 50)
			{
				return "first name или last name превышают 50 символов";
			}
       	// check: user already exists?
		$sql = "SELECT * from users WHERE email = :email";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindValue("email", $email);
		$stmt->execute();
       	$row = $stmt->fetch();
       	if (!empty($row)) 
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
       	// putting data into db
       	$password = password_hash($password, PASSWORD_DEFAULT);
	    $sql = "INSERT INTO users (email, password, first_name, last_name, registration_date, latest_activity) VALUES(:email, :password, :first_name, :last_name, NOW(), NOW())";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindValue("email", $email);
		$stmt->bindValue("password", $password);
		$stmt->bindValue("first_name", $first_name);
		$stmt->bindValue("last_name", $last_name);
		$success = $stmt->execute();
		// if something wrong...
		if (!$success) return "Что-то пошло не так...";
		// if all correct
		return "success";		       		

	}
}