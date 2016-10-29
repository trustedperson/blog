<?
class Controller_Login extends Controller {
	
	function action_index() {
    	if ($this->session_exists()) $this::homePage();
    	$this->view->generate('login_view.php','template_view.php');

	}

	function homePage() {
		$host = 'https://'.$_SERVER['HTTP_HOST'].'/';
  		//header('HTTPS/1.1 404 Not Found');
		// header("Status: 404 Not Found");
		header('Location:'.$host.'main');
		exit;
	}

	function session_exists() {
		if(!empty($_SESSION['id']) or !empty($_SESSION['login'])) {
			return true;
		}
		return false;
	}	

}