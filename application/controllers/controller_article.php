<?
class Controller_Article extends Controller
{
	function action_index()
	{
		go_Url('blog');
	}

	function action_new()
	{
		reject_if_not_logged_in('blog');
		$this->view->generate('new_article_view.php', 'template_view.php');
	}

	function action_create()
	{
		reject_if_not_logged_in('blog');
		$this->model = new Model_Article();
		$result = $this->model->createArticle();
		if($result == "success")
		{
			$_SESSION['user_msg'] = "Статья создана!";
			go_Url('blog');
		}
		else 
		{
			$_SESSION['user_msg'] = $result;
			go_Url('article/new/');
		}
	}

	function action_read()
	{
		$this->model = new Model_Article();
		$result = $this->model->getArticle();
		if($result == "fail")
		{
			go_Url('blog');
		}
		$this->view->generate('article_view.php', 'template_view.php', $result);
	}
	function action_update()
	{
		$this->model = new Model_Article();
	}
	function action_delete()
	{
		$this->model = new Model_Article();
	}
}