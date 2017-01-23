<?
class Model_Blog extends Model
{
	function getArticleTitles()
	{
		$sql = "SELECT * FROM articles WHERE state = 'publicated'";
		$stmt = $this->pdo->query($sql);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
}