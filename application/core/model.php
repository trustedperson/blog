<?
require 'vendor/autoload.php';
use Doctrine\Common\ClassLoader;

class Model {
	public $conn;
	function __construct() {
		require 'vendor/doctrine/common/lib/Doctrine/Common/ClassLoader.php';
		$classLoader = new ClassLoader('Doctrine', '/vendor/doctrine/common');
		$classLoader->register();		

		// global $db_name;
		global $db_user;
		global $db_password;
		global $db_host;
		global $db_name;
		$config = new \Doctrine\DBAL\Configuration();
		$connectionParams = array(
		    'dbname' => $db_name,
		    'user' => $db_user,
		    'password' => $db_password,
		    'host' => $db_host,
		    'driver' => 'pdo_mysql',
		);
		$this->conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);
	}

	public function get_data()
	{
	}
}