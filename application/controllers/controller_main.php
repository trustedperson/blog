<?
class Controller_Main extends Controller {
	function action_index() {
		$data = empty($_SESSION['user_msg']) ? "" : $_SESSION['user_msg'];
    	unset($_SESSION['user_msg']);
		$this->view->generate(null, 'index_view.php', $data);
	}
}