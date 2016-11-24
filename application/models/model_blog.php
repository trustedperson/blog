<?
class Model_Blog extends Model
{
	function getArticleTitles()
	{
		$sql = "SELECT * FROM articles WHERE deleted IS NULL";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		return $stmt;
	}
}