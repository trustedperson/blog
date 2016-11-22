<?
class Model_Blog extends Model
{
	function getArticleTitles()
	{
		$sql = "SELECT * FROM articles";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		return $stmt;
	}

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
}