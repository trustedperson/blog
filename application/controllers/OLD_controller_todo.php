<?
class Controller_Todo extends Controller
{
	function action_index()
		{
			reject_if_not_logged_in();
			$this->model = new Model_Todo();
			$tasks = $this->model->get_task_list();
			$this->view->generate('todo_view.php', 'template_view.php', $tasks);
		}

	function action_create()
		{
			reject_if_not_logged_in();
			$this->model = new Model_Todo();
			$this->model->create();
			go_Url("todo");
		}

	function action_read()
		{
			reject_if_not_logged_in();
			$this->model = new Model_Todo();
		}

	function pre_update()
	{
		
	}

	function action_update()
		{
			reject_if_not_logged_in();
			$this->model = new Model_Todo();
		}

	function action_delete()
		{
			reject_if_not_logged_in();
			$this->model = new Model_Todo();
			$this->model->delete();
			go_Url("todo");
		}



}