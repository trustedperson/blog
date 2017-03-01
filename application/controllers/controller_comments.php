<?
class Controller_Comments extends Controller
{
	function action_index()
	{
		go_Url('blog');
	}

	function action_approve()
	{
		reject_if_not_logged_in('login');
		$this->model = new Model_Comments();
		$res = $this->model->approve();
		if ($res)
		{
			$_SESSION['user_msg'] = "Каммент подтвержден!";
			go_Url('profile/moderation');
		}
		else 
		{
			$_SESSION['user_msg'] = "Что то пошло не так..";
			go_Url('profile/moderation');
		}
	}
}