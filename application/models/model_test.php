<?
class Model_Test extends Model
{
	function index()
	{
		$id = 1500000;
		$start = microtime(true);
		$xml = new SimpleXMLElement("/home/a/aarena5q/demo.qweekdev.com/public_html/test.xml", NULL , true);
		echo "open xml file with ".(microtime(true) - $start)." seconds;\n";
		echo "test page<br>";
		echo "DB and xml row count = 2 000 000<br>";
		echo "we search row with this number = 1 500 000<br>";
		echo "all search use microtime(true) function<br><br>";
		echo "DB 1 run<br>";	
		$start = microtime(true);
		$res = $this->pdo->query(("SELECT name FROM test WHERE id =".$id), PDO::FETCH_ASSOC);
		echo "time elapsed: " . (microtime(true) - $start) . " ;<br>";

		echo "DB 2 run<br>";
		$start = microtime(true);
		$this->pdo->query(("SELECT name FROM test WHERE id =".$id), PDO::FETCH_ASSOC);
		echo "time elapsed: " . (microtime(true) - $start) . " ;<br>";

		echo "DB 3 run<br>";
		$start = microtime(true);
		$res = $this->pdo->query(("SELECT name FROM test WHERE id =".$id), PDO::FETCH_ASSOC);
		echo "time elapsed: " . (microtime(true) - $start) . " ;<br><br>";
		
		echo "XML (direct access) 1 run<br>";
		$start = microtime(true);
		echo "result value is: ".$xml->news[1500000]." || ";
		echo "time elapsed: " . (microtime(true) - $start) . " ;<br>";
	
		echo "XML (direct access) 2 run<br>";
		$start = microtime(true);
		echo "result value is: ".$xml->news[1500000]." || ";
		echo "time elapsed: " . (microtime(true) - $start) . " ;<br>";
	
		echo "XML (direct access) 3 run<br>";
		$start = microtime(true);
		echo "result value is: ".$xml->news[1500000]." || ";
		echo "time elapsed: " . (microtime(true) - $start) . " ;<br><br>";
	}

	function createdb()
	{
		echo "create db page<br>";
		$sql = "INSERT INTO test (name) VALUES (:i)";
		$stmt = $this->pdo->prepare($sql);
		for ($i=0; $i < 2000000; $i++)
		{ 
			$stmt->bindValue(":i", $i, PDO::PARAM_INT);			
			$stmt->execute();
		}
		echo "i = " . $i . ";";
	}

	function createxml()
	{

	}

}