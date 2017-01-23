<?
class Model
{
	public $pdo;
	function __construct()
	{
		global $db_user;
		global $db_password;
		global $db_host;
		global $db_name;
		$dsn = "mysql:host=".$db_host.";dbname=".$db_name.";charset=utf8mb4";
		$this->pdo = new PDO($dsn, $db_user, $db_password);
		$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	}

	public function get_data()
	{
	}
}