<?
class Model_Article extends Model
{
	function getArticle()
	{
		$routes = explode('/', $_SERVER['REQUEST_URI']);
		if(!$routes[3])
		{
			return "fail";
		}

		$sql = "SELECT * FROM articles_details WHERE article_id = :article_id ";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindValue("article_id", $routes[3]);
		$stmt->execute();
		return $stmt;
	}

	function createArticle()
	{
		// check: empty parameters?
		if (empty($_POST['title']) or empty($_POST['short_text']) or empty($_POST['text'])) 
			{
				return "Вы ввели не всю информацию!";
			}
		else
			{
				$title = $_POST['title'];
				$short_text = $_POST['short_text'];
				$text = $_POST['text'];
			}
		// check: lenght is correct?

		// put data into db
		$this->conn->beginTransaction();
		try
		{
			// insert into articles
			$sql = "INSERT INTO articles (owner_id, title, short_text, creation_date) VALUES (:owner_id, :title, :short_text, NOW())";				
			$stmt = $this->conn->prepare($sql);
			$stmt->bindValue("owner_id", $_SESSION['id']);
			$stmt->bindValue("title", $title);
			$stmt->bindValue("short_text", $short_text);
			$stmt->execute();
			// get atricle ID
			$stmt = $this->conn->prepare("SELECT MAX(id) FROM articles");
			$stmt->execute();
			$id = $stmt->fetchColumn();
			// insert into articles_details
			$sql = "INSERT INTO articles_details (article_id, text) VALUES (:article_id, :text)";				
			$stmt = $this->conn->prepare($sql);
			$stmt->bindValue("article_id", $id);
			$stmt->bindValue("text", $text);
			$stmt->execute();

			$this->conn->commit();
			return "success";
		} 
		catch (Exception $e)
		{
			$this->conn->rollBack();
    		throw $e;
		}
	}
}