<?
class Controller_Article extends Controller
{
	function action_index()
	{
		go_Url('blog');
	}

	function action_new()
	{
		reject_if_not_logged_in('login');
		$this->view->generate('new_article_view.php', 'template_view.php');
	}

	function action_edit()
	{
		reject_if_not_logged_in('login');
		$this->model = new Model_Article();
		$res = $this->model->getFullArticle();
		$this->view->generate('edit_article_view.php', 'template_view.php', $res);
	}

	function action_create()
	{
		reject_if_not_logged_in('blog');
		$this->model = new Model_Article();
		$this->model->createArticle();
	}

	function action_read()
	{
		$this->model = new Model_Article();
		$res['article'] = $this->model->getFullArticle();
		$res['comments'] = $this->model->getComments();
		$this->view->generate('article_view.php', 'template_view.php', $res);
	}

	function action_update()
	{
		$this->model = new Model_Article();
		$this->model->updateArticle();
	}

	function action_delete()
	{
		reject_if_not_logged_in('blog');
		$this->model = new Model_Article();
		$res = $this->model->deleteArticle();
		if($res == "no_perm")
		{
			$_SESSION['user_msg'] = "У Вас нет прав";
			go_Url('blog');
		}
		if($res == 'success')
		{
			$_SESSION['user_msg'] = "Статья удалена!";
			go_Url('blog');
		}
	}
}