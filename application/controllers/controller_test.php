<?
class Controller_Test extends Controller
{
	function action_index()
	{
		reject_if_not_logged_in('login');
		include '../application/views/test_view.php';
	}
}