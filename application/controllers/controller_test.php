<?
class Controller_Test extends Controller
{
	function action_index()
	{
		reject_if_not_logged_in('login');
		$this->model = new Model_Test();
		$this->model->index();
	}

	function action_createdb()
	{
		reject_if_not_logged_in('login');		
		$this->model = new Model_Test();
		$this->model->createdb();
	}

	function action_createxml()
	{
		reject_if_not_logged_in('login');		
		$this->model = new Model_Test();
		$this->model->createxml();
	}
} 