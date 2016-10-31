<?
class Controller_Portfolio extends Controller
{
	function action_index() 
	{
		$this->view->generate('portfolio_view.php', 'template_view.php');
	}
}