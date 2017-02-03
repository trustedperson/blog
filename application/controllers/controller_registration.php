<?
class Controller_Registration extends Controller {
	
	function action_index() {
		//////// registration disabled
		$_SESSION['user_msg'] = "Регистрация недоступна<br>";
		go_Url("blog");
		// put some message in $data if message exists
    	$data = empty($_SESSION['user_msg']) ? "" : $_SESSION['user_msg'];
    	unset($_SESSION['user_msg']);

		$this->view->generate('registration_view.php','template_view.php', $data);
	}

	function action_enter() {
		//////// registration disabled
		$_SESSION['user_msg'] = "Регистрация недоступна<br>";
		go_Url("blog");
		$this->model = new Model_Registration();
		$result = $this->model->validateInputAndInsert();
		if ($result == 'success') 
			{
				$_SESSION['user_msg'] = "Регистрация успешно завершена!";
				go_Url('main');
			}
			else 
				{
					$_SESSION['user_msg'] = $result;
					go_Url('registration');				
				}
	}
}