<?
class Model {
	public $db;
	function __construct() {
		include_once "include/ez_sql_core.php";
		include_once "include/ez_sql_mysql.php";
		include_once "../db_conf";
		$this->db = new ezSQL_mysql($db_user,$db_password,$db_name,$db_host);
	}

	public function get_data()
	{
	}
}