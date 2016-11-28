<?
class Controller_Profile extends Controller
{
	function action_index()
	{
		reject_if_not_logged_in('login');
		go_Url('profile/articles');
	}

	function action_articles()
	{
		reject_if_not_logged_in('login');
		$this->model = new Model_Profile();
		$res = $this->model->getMyArticles();
		$this->view->generate('my_articles_view.php', 'template_view.php', $res);
	}
}