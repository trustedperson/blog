<?
class Model_Blog extends Model
{
	function getArticleTitles()
	{
		$sql = "
		SELECT
			* 
		FROM
			articles 
		WHERE
			state = 'publicated'";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		return $stmt;
	}
}