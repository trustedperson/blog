<?
if(!empty($_SESSION['user_msg']))
	{
		echo $_SESSION['user_msg'];
		unset($_SESSION['user_msg']);
	}
?>

<?

?>
<form action="article/update/" method="post">
	<?
	echo "<input type='hidden' name='id' value='".$data['id']."'>"
	?>
	<label>Заголовок!</label>
	<br>
	<textarea class="article_title" name="title"><? echo $data['title']; ?></textarea>
	<br>
	<label>Краткое описание</label>
	<br>
	<textarea class="article_short_text" name="short_text"><? echo $data['short_text']; ?></textarea>
	<br>
	<label>Текст статейки тут</label>
	<br>
	<textarea class="article_fulltext" name="text"><? echo $data['text']; ?></textarea>
	<button type="submit">Сохранить</button>
</form>