<?
class Controller_Blog extends Controller
{
	function action_index() 
	{
		$this->model = new Model_Blog();
		$result = $this->model->getArticleTitles();
		$this->view->generate('blog_view.php', 'template_view.php', $result);
	}

	function action_article()
	{
		$this->model = new Model_Blog();
		$result = $this->model->getArticle();
		if($result == "fail")
		{
			go_Url('blog');
		}
		$this->view->generate('article_view.php', 'template_view.php', $result);	
	}
}