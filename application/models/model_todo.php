<?
class Model_Todo extends Model
{
	public $last_serial_number;
	function __construct()
	{
		parent::__construct();
		$id = $_SESSION['id'];
		$this->last_serial_number = $this->db->get_var("SELECT serial_number FROM tasks WHERE id_user='$id' ORDER BY serial_number DESC LIMIT 1");
	}

	function get_task_list()
	{
		$email = $_SESSION['email'];
		$user_row = $this->db->get_row("SELECT * FROM users WHERE email='$email'");
		$tasks = $this->db->get_results("SELECT * FROM tasks WHERE tasks.id_user='$user_row->id'");
		return $tasks;
	}

	function create()
	{
		$email = $_SESSION['email'];
		$task = $_POST['task'];
		$id = $_SESSION['id'];
		$this->last_serial_number++;
		$this->db->query("INSERT INTO tasks(serial_number, task, id_user) VALUES('$this->last_serial_number', '$task', '$id')");
	}

	function read()
	{

	}

	function update()
	{

	}

	function delete()
	{
		$serial_number = $_POST['serial_number'];
		$id = $_SESSION['id'];
		$this->db->query("DELETE FROM tasks WHERE tasks.id_user='$id' AND tasks.serial_number='$serial_number'");
	}

}