<?
class Controller_Login extends Controller {
	
	function action_index() {
    	if ($this->session_exists())
    		{
    			$this::go_Url('main');
    		}
    	$this->view->generate('login_view.php','template_view.php', empty($_SESSION['login_error']) ? "" : $_SESSION['login_error']);
    	unset($_SESSION['login_error']);
	}

	function action_enter() {
		$this->model = new Model_Login();
		$result = $this->model->validate($_POST['login'], $_POST['password']);
		if($result == 'success')
			{
				$this::go_Url('main');
			} 
		else 
			{
				$_SESSION['login_error'] = $result;
				$this::go_Url('login');
			}
	}

	
function go_Url($url) {
	$host = 'https://'.$_SERVER['HTTP_HOST'].'/';
		//header('HTTPS/1.1 404 Not Found');
	// header("Status: 404 Not Found");
	header('Location:'.$host.$url);
	exit;
}

function session_exists() {
		if(!empty($_SESSION['id']) or !empty($_SESSION['login'])) {
			return true;
		}
		return false;
	}

		

}