<?
class Model_Article extends Model
{
	function getFullArticle()
	{
		$routes = explode('/', $_SERVER['REQUEST_URI']);
		if(!$routes[3])
		{
			return "fail";
		}
		$sql = "SELECT a.id, owner_id, title, short_text, text FROM articles AS a, articles_details AS ad WHERE ad.article_id = ? AND a.id = ? AND deleted IS NULL";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindValue(1, $routes[3]);
		$stmt->bindValue(2, $routes[3]);
		$stmt->execute();
		// if no rows affected..
		if($stmt->rowCount() == 0)
		{
			return "no_exist";
		}
		return $stmt->fetch();
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

		// putting data into db
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
			$id = $this->conn->lastInsertId();
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

	function updateArticle()
	{
		// check: empty parameters?
		if (empty($_POST['title']) or empty($_POST['short_text']) or empty($_POST['text']) or empty($_POST['id'])) 
			{
				return "Вы ввели не всю информацию!";
			}
		else
			{
				$id = $_POST['id'];
				$title = $_POST['title'];
				$short_text = $_POST['short_text'];
				$text = $_POST['text'];
			}
		// check: have permission?
		$sql = "SELECT owner_id FROM articles WHERE id = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindValue("id", $_POST['id']);
		$stmt->execute();
		if($stmt->fetch()['owner_id'] != $_SESSION['id'])
		{
			return "no_perm";
		}
		// putting data into db
		$this->conn->beginTransaction();
		try
		{
			// insert into articles
			$sql = "UPDATE articles SET id = :id, owner_id = :owner_id, title = :title, short_text = :short_text WHERE id = :id AND deleted IS NULL";				
			$stmt = $this->conn->prepare($sql);
			$stmt->bindValue("id", $id);
			$stmt->bindValue("owner_id", $_SESSION['id']);
			$stmt->bindValue("title", $title);
			$stmt->bindValue("short_text", $short_text);
			$stmt->execute();
			// get atricle ID
			// insert into articles_details
			$sql = "UPDATE articles_details AS ad JOIN articles AS a ON ad.article_id = a.id SET text = :text WHERE article_id = :article_id AND deleted IS NULL";				
			$stmt = $this->conn->prepare($sql);
			$stmt->bindValue("article_id", $id);
			$stmt->bindValue("text", $text);
			$stmt->execute();
			$this->conn->commit();
			// if no rows affected..
			if($stmt->rowCount() == 0)
			{
			return "no_exist";
			}

			return "success";
		} 
		catch (Exception $e)
		{
			$this->conn->rollBack();
    		throw $e;
		}
	}

	function deleteArticle()
	{
		$routes = explode('/', $_SERVER['REQUEST_URI']);
		if(!$routes[3])
		{
			return "Не указан номер статьи";
		}
		// check: have permission?
		$sql = "SELECT owner_id FROM articles WHERE id = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindValue("id", $routes[3]);
		$stmt->execute();
		if($stmt->fetch()['owner_id'] != $_SESSION['id'])
		{
			return "no_perm";
		}
		// set flag "deleted"
		$sql = "UPDATE articles SET deleted = :deleted WHERE id = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindValue("deleted", 1);
		$stmt->bindValue("id", $routes[3]);
		$stmt->execute();
		return "success";
	}
}