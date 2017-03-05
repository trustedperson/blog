<div class="item">
	<a href="article/read/<? echo $row['id']?>">
		<? echo $row['title'] ?>
	</a>
	<br>
		<? echo $row['short_text'] ?>
	<br>
	<a href="article/edit/<? echo $row['id'] ?>">
		Редактировать
	</a>

	<?
		if($row['state'] == "draft") 
		{
			$txt = "Опубликовать";
			$action = "restore";
		}
		else
		{
			$txt = "Снять с публикации";
			$action = "close";		
		}
	?>

	<a href="article/<? echo $action."/".$row['id'] ?>">
		<? echo $txt ?>
	</a>
	<a href="article/destroy/<? echo $row['id'] ?>">
		Уничтожить навсегда
	</a>
	<br><br>
</div>