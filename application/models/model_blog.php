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
}