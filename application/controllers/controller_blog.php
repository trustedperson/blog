<?
class Controller_Blog extends Controller
{
	function action_index() 
	{
		$this->model = new Model_Blog();
		$result = $this->model->getArticleTitles();
		$this->view->generate('blog_view.php', 'template_view.php', $result);
	}

	
}