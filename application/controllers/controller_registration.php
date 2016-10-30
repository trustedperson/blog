<?
class Controller_Registration extends Controller {
	
	function action_index() {

		// put error message in $data if message exists
    	$data = empty($_SESSION['registration_error']) ? "" : $_SESSION['registration_error'];
    	unset($_SESSION['registration_error']);

		$this->view->generate('registration_view.php','template_view.php', $data);
	}

	function action_enter() {
		$this->model = new Model_Registration();
		$result = $this->model->validateInputAndWrite();
		if ($result == 'success') 
			{
				go_Url('main');
			}
			else 
				{
					$_POST['registration_error'] = $result;
					go_Url('registration');				
				}
	}

}