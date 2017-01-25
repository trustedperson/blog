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
		reject_if_not_logged_in('login');
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
		reject_if_not_logged_in('login');
		$this->model = new Model_Article();
		$this->model->updateArticle();
	}

	function action_close()
	{
		reject_if_not_logged_in('login');
		$this->model = new Model_Article();
		$this->model->closeArticle();
	}

	function action_restore()
	{
		reject_if_not_logged_in('login');
		$this->model = new Model_Article();
		$res = $this->model->restoreArticle();
	}

	function action_destroy()
	{
		reject_if_not_logged_in('login');
		$this->model = new Model_Article();
		$this->model->destroyArticle();
	}

	function action_new_comment()
	{
		$this->model = new Model_Article();
		$this->model->newComment();
	}
}