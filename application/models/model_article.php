<?
class Model_Article extends Model
{
	function getFullArticle()
	{
		$routes = explode('/', $_SERVER['REQUEST_URI']);
		if(!$routes[3])
		{
			go_Url('blog');
		}
		$id = $routes[3];
		// sql
		$sql = "
		SELECT
			a.*, text 
		FROM 
			articles AS a, 
			articles_details AS ad 
		WHERE 
			ad.article_id = :id AND a.id = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindValue("id", $routes[3]);
		$stmt->execute();
		$res = $stmt->fetch();
		// end sql
		if(empty($res['id']))
		{
			go_Url('blog');
		}
		// permission check
		if(session_exists())
		{
			if($res['owner_id'] != $_SESSION['id'])
			{
				if($res['state'] == "draft")
				{
					go_Url('blog');
				}
				else
				{
					return $res;
				}
			}
			else
			{
				return $res;
			}
		}
		else
		{
			if($res['state'] == "draft")
			{
				go_Url('blog');
			}
			else
			{
				return $res;
			}
		}
	}

	function createArticle()
	{
		// check: empty parameters?
		if (empty($_POST['title']) or empty($_POST['short_text']) or empty($_POST['text'])) 
			{
				$_SESSION['user_msg'] = "Заполните все поля!";
				go_Url('article/new/');
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
			$sql = "INSERT INTO articles (owner_id, title, short_text, creation_date, state) VALUES (:owner_id, :title, :short_text, NOW(), 'publicated')";				
			$stmt = $this->conn->prepare($sql);
			$stmt->bindValue("owner_id", $_SESSION['id']);
			$stmt->bindValue("title", $title);
			$stmt->bindValue("short_text", $short_text);
			$stmt->execute();
			// get atricle ID
			$new_id = $this->conn->lastInsertId();
			// insert into articles_details
			$sql = "INSERT INTO articles_details (article_id, text) VALUES (:new_id, :text)";				
			$stmt = $this->conn->prepare($sql);
			$stmt->bindValue("new_id", $new_id);
			$stmt->bindValue("text", $text);
			$stmt->execute();

			$this->conn->commit();
			$_SESSION['user_msg'] = "Статья создана!";
			go_Url('blog');
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
		if(empty($_POST['id']))
		{
			go_Url('blog');	
		}
		if (empty($_POST['title']) or empty($_POST['short_text']) or empty($_POST['text'])) 
		{
			$_SESSION['user_msg'] = "Заполните обязательные поля!";
			go_Url('article/edit/'.$_POST['id']);
		}
		$id = $_POST['id'];
		$title = $_POST['title'];
		$short_text = $_POST['short_text'];
		$text = $_POST['text'];
		// check: have permission, article exists?
		$sql = "SELECT id, owner_id FROM articles WHERE id = :post_id";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindValue("post_id", $_POST['id']);
		$stmt->execute();
		$res = $stmt->fetch();
		if(empty($res['id']))
		{
			$_SESSION['user_msg'] = "Такой статьи нет";
			go_Url('blog');
		}
		if($res['owner_id'] != $_SESSION['id'])
		{
			$_SESSION['user_msg'] = "У Вас нет прав";
			go_Url('blog');
		}
		// putting data into db
		$this->conn->beginTransaction();
		try
		{
			// insert into articles
			$sql = "UPDATE articles SET id = :id, owner_id = :sess_id, title = :title, short_text = :short_text WHERE id = :id";				
			$stmt = $this->conn->prepare($sql);
			$stmt->bindValue("id", $id);
			$stmt->bindValue("sess_id", $_SESSION['id']);
			$stmt->bindValue("title", $title);
			$stmt->bindValue("short_text", $short_text);
			$stmt->execute();
			// insert into articles_details
			$sql = "UPDATE articles_details AS ad JOIN articles AS a ON ad.article_id = a.id SET text = :text WHERE article_id = :article_id";				
			$stmt = $this->conn->prepare($sql);
			$stmt->bindValue("article_id", $id);
			$stmt->bindValue("text", $text);
			$stmt->execute();
			$this->conn->commit();
			$_SESSION['user_msg'] = "Статья сохранена!";
			go_Url('article/read/'.$id);
		} 
		catch (Exception $e)
		{
			$this->conn->rollBack();
    		throw $e;
		}
	}

	function closeArticle()
	{
		$routes = explode('/', $_SERVER['REQUEST_URI']);
		if(!$routes[3])
		{
			$_SESSION['user_msg'] = "Укажите номер статьи";
			go_Url('blog');
		}
		// check: have permission, article already deleted?
		$sql = "SELECT owner_id, state FROM articles WHERE id = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindValue("id", $routes[3]);
		$stmt->execute();
		$res = $stmt->fetch();
		if($res['owner_id'] != $_SESSION['id'])
		{
			$_SESSION['user_msg'] = "У Вас нет прав";
			go_Url('blog');
		}
		if($res['state'] == "deleted")
		{
			$_SESSION['user_msg'] = "Статья уже снята с публикации!";
			go_Url('profile/articles');
		}
		// set state to draft
		$sql = "UPDATE articles SET state = :draft WHERE id = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindValue("draft", "draft");
		$stmt->bindValue("id", $routes[3]);
		$stmt->execute();
		$_SESSION['user_msg'] = "Статья снята с публикации!";
		go_Url('profile/articles');
	}

	function restoreArticle()
	{
		$routes = explode('/', $_SERVER['REQUEST_URI']);
		if(!$routes[3])
		{
			$_SESSION['user_msg'] = "Укажите номер статьи";
			go_Url('blog');
		}
		// check: have permission, article already publicated?
		$sql = "
		SELECT 
			owner_id, state
		FROM 
			articles 
		WHERE 
			id = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindValue("id", $routes[3]);
		$stmt->execute();
		$res = $stmt->fetch();
		if($res['owner_id'] != $_SESSION['id'])
		{
			$_SESSION['user_msg'] = "У Вас нет прав";
			go_Url('blog');
		}
		if($res['state'] == "publicated")
		{
			$_SESSION['user_msg'] = "Статья уже опубликована!";
			go_Url('profile/articles');
		}
		// set state to publicated
		$sql = "UPDATE articles SET state = :publicated WHERE id = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindValue("publicated", "publicated");
		$stmt->bindValue("id", $routes[3]);
		$stmt->execute();
		$_SESSION['user_msg'] = "Статья опубликована!";
		go_Url('profile/articles');
	}

	function getComments()
	{
		$routes = explode('/', $_SERVER['REQUEST_URI']);
		if(!$routes[3])
		{
			go_Url('blog');
		}
		$id = $routes[3]; 
		$sql = "
		SELECT 
			*
		FROM 
			comments
		WHERE 
			article_id = :article_id AND state = 'publicated'";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindValue("article_id", $id);
		$stmt->execute();
		return $stmt->fetchALL();
	}

	function newComment()
	{
		$owner_id = session_exists() ? $_SESSION['id'] : "";
		if(empty($_POST['article_id']))
		{
			go_Url('blog');
		}
		if(empty($_POST['comment_text']) or empty($_POST['commenter_name']))
		{
			$_SESSION['user_msg'] = "Не заполнены поля!";
			go_Url('article/read/'.$_POST['article_id']);
		}
		$sql = "
		INSERT INTO 
		comments(
			article_id,
			owner_id,
			commenter_name,
			text,
			state,
			creation_date)
		VALUES
			(:article_id,
			:sess_id,
			:commenter_name,
			:comment_text,
			'publicated',
			NOW())";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindValue("article_id", $_POST['article_id']);
		$stmt->bindValue("sess_id", $owner_id);
		$stmt->bindValue("commenter_name", $_POST['commenter_name']);
		$stmt->bindValue("comment_text", $_POST['comment_text']);
		$stmt->execute();
		$_SESSION['user_msg'] = "Каммент создан!";
		go_Url('article/read/'.$_POST['article_id']);
	}

	function deleteComment()
	{

	}
}