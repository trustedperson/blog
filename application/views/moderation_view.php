<?
if(!empty($_SESSION['user_msg']))
	{
		echo $_SESSION['user_msg']."<br>";
		unset($_SESSION['user_msg']);
	}

while($row = $data->fetch())
{
	echo $row['creation_date'] . "<br>";
	echo $row['commenter_name'] . "<br>";
	echo $row['text'] . "<br>";
	echo "<a href='comments/approve/?id=" . $row['id'] . "'>Подтвердить комментарий.</a><br><br>";
}

