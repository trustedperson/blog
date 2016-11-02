<?
class Controller_Registration extends Controller {
	
	function action_index() {

		// put some message in $data if message exists
    	$data = empty($_SESSION['user_msg']) ? "" : $_SESSION['user_msg'];
    	unset($_SESSION['user_msg']);

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
					$_SESSION['user_msg'] = $result;
					go_Url('registration');				
				}
	}

}