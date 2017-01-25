<?
if(!empty($_SESSION['user_msg']))
	{
		echo $_SESSION['user_msg']."<br>";
		unset($_SESSION['user_msg']);
	}
?>
<a href="article/new/">Создать</a>
<br>
<?
while($row = $data->fetch())
	{
		echo "<a href='article/read/".$row['id']."'>".$row['title']."<a/>"."<br>";
		echo $row['short_text']."<br>";
		echo "<a href='article/edit/".$row['id']."'>"."Редактировать</a>";
		if($row['state'] == "draft")
		{
			echo "<a href='article/restore/".$row['id']."'>"."Опубликовать</a>";
		}
		else
		{
			echo "<a href='article/close/".$row['id']."'>"."Снять с публикации</a>";	
		}
		echo "<a href='article/destroy/".$row['id']."'>X</a>";
		echo "<br><br>";
	}