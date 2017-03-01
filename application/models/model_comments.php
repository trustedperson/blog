<?
class Model_Comments extends Model
{
	function approve()
	{
		if (is_numeric($_GET['id']) && (int)$_GET['id'] > 0)
			$comment_id = (int)$_GET['id'];
		else
		{
			$_SESSION['user_msg'] = "Ваш параметр херня";
			go_Url('profile/moderation');
		}
		$stmt = $this->pdo->prepare("UPDATE comments SET state = :state WHERE id = :id");
		$stmt->bindValue(":state", "publicated", PDO::PARAM_STR);
		$stmt->bindValue(":id", $comment_id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->rowCount();
	}
}