<?
class Model_Article extends Model
{
	function getFullArticle()
	{
		$routes = Route::$routes;
		if(!$routes[3])
		{
			go_Url('blog');
		}
		$id = $routes[3];
		// sql
		$sql = "SELECT a.*, text FROM articles AS a, articles_details AS ad WHERE ad.article_id = :id AND a.id = :aid";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(":id", $routes[3], PDO::PARAM_INT);
		$stmt->bindValue(":aid", $routes[3], PDO::PARAM_INT);
		$stmt->execute();
		$res = $stmt->fetch(PDO::FETCH_ASSOC);
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
		$this->pdo->beginTransaction();
		try
		{
			// insert into articles
			$sql = "INSERT INTO articles (owner_id, title, short_text, creation_date, state) VALUES (:owner_id, :title, :short_text, NOW(), 'publicated')";				
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindValue(":owner_id", $_SESSION['id'], PDO::PARAM_STR);
			$stmt->bindValue(":title", $title, PDO::PARAM_STR);
			$stmt->bindValue(":short_text", $short_text, PDO::PARAM_STR);
			$stmt->execute();
			// get atricle ID
			$new_id = $this->pdo->lastInsertId();
			// insert into articles_details
			$sql = "INSERT INTO articles_details (article_id, text) VALUES (:new_id, :text)";				
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindValue(":new_id", $new_id, PDO::PARAM_INT);
			$stmt->bindValue(":text", $text, PDO::PARAM_STR);
			$stmt->execute();
			// $uploaddir = '/home/a/aarena5q/demo.qweekdev.com/public_html/images/';
			// $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
			// if (!move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile))
			// {
			// 	$this->pdo->rollBack();
			// 	$_SESSION['user_msg'] = $_FILES['userfile']['error'];
			// 	go_Url('article/new/');
			// }
			$this->pdo->commit();
			$_SESSION['user_msg'] = "Статья создана!";
			go_Url('blog');
		} 
		catch (PDOException $ex)
		{
			$this->pdo->rollBack();
    		echo $ex->getMessage();
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
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(":post_id", $_POST['id'], PDO::PARAM_INT);
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
		$this->pdo->beginTransaction();
		try
		{
			// insert into articles
			$sql = "UPDATE articles SET id = :id, owner_id = :sess_id, title = :title, short_text = :short_text WHERE id = :aid";				
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindValue(":id", $id, PDO::PARAM_INT);
			$stmt->bindValue(":sess_id", $_SESSION['id'], PDO::PARAM_INT);
			$stmt->bindValue(":title", $title, PDO::PARAM_STR);
			$stmt->bindValue(":short_text", $short_text, PDO::PARAM_STR);
			$stmt->bindValue(":aid", $id, PDO::PARAM_INT);
			$stmt->execute();
			// insert into articles_details
			$sql = "UPDATE articles_details AS ad JOIN articles AS a ON ad.article_id = a.id SET text = :text WHERE article_id = :article_id";				
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindValue(":text", $text, PDO::PARAM_STR);
			$stmt->bindValue(":article_id", $id, PDO::PARAM_INT);
			$stmt->execute();
			$this->pdo->commit();
			$_SESSION['user_msg'] = "Статья сохранена!";
			go_Url('article/read/'.$id);
		} 
		catch (PDOException $ex)
		{
			$this->pdo->rollBack();
    		echo $ex->getMessage();
		}
	}

	function closeArticle()
	{
		$routes = Route::$routes;
		if(!$routes[3])
		{
			$_SESSION['user_msg'] = "Укажите номер статьи";
			go_Url('blog');
		}
		// check: have permission, article already deleted?
		$sql = "SELECT owner_id, state FROM articles WHERE id = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(":id", $routes[3], PDO::PARAM_INT);
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
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(":draft", "draft", PDO::PARAM_STR);
		$stmt->bindValue(":id", $routes[3], PDO::PARAM_INT);
		$stmt->execute();
		$_SESSION['user_msg'] = "Статья снята с публикации!";
		go_Url('profile/articles');
	}

	function restoreArticle()
	{
		$routes = Route::$routes;
		if(!$routes[3])
		{
			$_SESSION['user_msg'] = "Укажите номер статьи";
			go_Url('blog');
		}
		// check: have permission, article already publicated?
		$sql = "SELECT owner_id, state FROM articles WHERE id = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(":id", $routes[3], PDO::PARAM_INT);
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
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(":publicated", "publicated", PDO::PARAM_STR);
		$stmt->bindValue(":id", $routes[3], PDO::PARAM_INT);
		$stmt->execute();
		$_SESSION['user_msg'] = "Статья опубликована!";
		go_Url('profile/articles');
	}

	function destroyArticle()
	{
		$routes = Route::$routes;
		if(!$routes[3])
		{
			$_SESSION['user_msg'] = "Укажите номер статьи";
			go_Url('blog');
		}
		// check: have permission?
		$sql = "SELECT owner_id FROM articles WHERE id = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(":id", $routes[3], PDO::PARAM_INT);
		$stmt->execute();
		$res = $stmt->fetch();
		if($res['owner_id'] != $_SESSION['id'])
		{
			$_SESSION['user_msg'] = "У Вас нет прав";
			go_Url('blog');
		}
		// fully remove article from db (with comments)!!
		$this->pdo->beginTransaction();
		try
		{
			// first goes articles_details row
			$sql = "DELETE FROM articles_details WHERE articles_details.article_id = :id";
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindValue(":id", $routes[3], PDO::PARAM_INT);
			$stmt->execute(); 
			// then comments row
			$sql = "DELETE FROM comments WHERE comments.article_id = :id";
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindValue(":id", $routes[3], PDO::PARAM_INT);
			$stmt->execute();
			// then articles row
			$sql = "DELETE FROM articles WHERE articles.id = :id";
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindValue(":id", $routes[3], PDO::PARAM_INT);
			$stmt->execute();
			$this->pdo->commit();
			$_SESSION['user_msg'] = "Статья удалена!";
			go_Url('profile/articles/');
		}
		catch (PDOException $ex)
		{
			$this->pdo->rollBack();
    		echo $ex->getMessage();
		}
			
	}

	function getComments()
	{
		$routes = Route::$routes;
		if(!$routes[3])
		{
			go_Url('blog');
		}
		$id = $routes[3]; 
		$sql = "SELECT * FROM comments WHERE article_id = :article_id AND state = 'publicated'";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(":article_id", $id, PDO::PARAM_INT);
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
		$sql = "INSERT INTO	comments(
			article_id,
			owner_id,
			commenter_name,
			text,
			state,
			creation_date)
		VALUES(
			:article_id,
			:sess_id,
			:commenter_name,
			:comment_text,
			'publicated',
			NOW())";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(":article_id", $_POST['article_id'], PDO::PARAM_INT);
		$stmt->bindValue(":sess_id", $owner_id, PDO::PARAM_INT);
		$stmt->bindValue(":commenter_name", $_POST['commenter_name'], PDO::PARAM_STR);
		$stmt->bindValue(":comment_text", $_POST['comment_text'], PDO::PARAM_STR);
		$stmt->execute();
		$_SESSION['user_msg'] = "Каммент создан!";
		go_Url('article/read/'.$_POST['article_id']);
	}

	function deleteComment()
	{

	}
}