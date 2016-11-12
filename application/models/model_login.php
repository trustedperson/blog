<?
class Model_Login extends Model {

	function validateLoginAndLogIn() {
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

        // check: user exists in db, and password is correct?
		$sql = "SELECT * from users WHERE email='".$email."'";
       	$stmt = $this->conn->query($sql);
       	$row = $stmt->fetch();
       	if (empty($row['email']) or ($password != $row['password']))
	       	{
	       		return "Email или пароль введён не верно";	
	       	}
	    // validation passed
	    if ($password == $row['password']) 
	    	{
	            $_SESSION['id']=$row['id'];
	            $_SESSION['email']=$row['email'];
	            return "success";
	    	}
	    }
}