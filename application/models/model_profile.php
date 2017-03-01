<?
class Model_Profile extends Model
{
	function getMyArticles()
	{
		$sql = "SELECT * FROM articles WHERE owner_id = :sess_id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(":sess_id", $_SESSION['id']);
		$stmt->execute();
		return $stmt;
	}

	function getComments()
	{
		return $this->pdo->query("SELECT * FROM comments WHERE state = 'moderation'");
	}
}