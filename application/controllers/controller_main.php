<?
class Controller_Main extends Controller {
	function action_index() {
		$data = empty($_SESSION['registration_msg']) ? "" : $_SESSION['registration_msg'];
    	unset($_SESSION['registration_msg']);
		$this->view->generate('main_view.php', 'template_view.php', $data);
	}
}