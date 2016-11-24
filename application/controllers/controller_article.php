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
		$result = $this->model->getFullArticle();
		if($result == "fail")
		{
			$_SESSION['user_msg'] = "Уточните номер статьи!";
			go_Url('blog');
		}
		if($result == "no_exist")
		{
			$_SESSION['user_msg'] = "Такой статьи не существует";
			go_Url('blog');
		}
		if($result['owner_id'] != $_SESSION['id'])
		{
			$_SESSION['user_msg'] = "У вас нет прав";
			go_Url('blog');
		}
		$this->view->generate('edit_article_view.php', 'template_view.php', $result);
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
		$result = $this->model->getFullArticle();
		if($result == "fail")
		{
			go_Url('blog');
		}
		if($result == "no_exist")
		{
			$_SESSION['user_msg'] = "Такой статьи не существует";
			go_Url('blog');
		}

		$this->view->generate('article_view.php', 'template_view.php', $result);
	}

	function action_update()
	{
		reject_if_not_logged_in('blog');
		$this->model = new Model_Article();
		$result = $this->model->updateArticle();
		if($result == "success")
		{
			$_SESSION['user_msg'] = "Статья сохранена!";
			go_Url('blog');
		}
		if($result == "no_exist")
		{
			$_SESSION['user_msg'] = "Такой статьи не существует";
			go_Url('blog');
		}
		if($result == "no_perm")
		{
			$_SESSION['user_msg'] = "У Вас нет прав";
			go_Url('blog');
		}
		$_SESSION['user_msg'] = $result;
		go_Url('article/edit/');
	}

	function action_delete()
	{
		reject_if_not_logged_in('blog');
		$this->model = new Model_Article();
		$result = $this->model->deleteArticle();
		if($result == "no_perm")
		{
			$_SESSION['user_msg'] = "У Вас нет прав";
			go_Url('blog');
		}
		if($result == 'success')
		{
			$_SESSION['user_msg'] = "Статья удалена!";
			go_Url('blog');
		}
	}
}