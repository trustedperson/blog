<?
if(!empty($_SESSION['user_msg']))
	{
		echo $_SESSION['user_msg'];
		unset($_SESSION['user_msg']);
	}
?>

<?
$row = $data->fetch();
?>
<form action="article/update/" method="post">
	<?
	echo "<input type='hidden' name='id' value='".$row['id']."'>"
	?>
	<label>Заголовок!</label>
	<br>
	<textarea class="article_title" name="title"><? echo $row['title']; ?></textarea>
	<br>
	<label>Краткое описание</label>
	<br>
	<textarea class="article_short_text" name="short_text"><? echo $row['short_text']; ?></textarea>
	<br>
	<label>Текст статейки тут</label>
	<br>
	<textarea class="article_fulltext" name="text"><? echo $row['text']; ?></textarea>
	<button type="submit">Сохранить</button>
</form>