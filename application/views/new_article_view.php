<?
if(!empty($_SESSION['user_msg']))
	{
		echo $_SESSION['user_msg'];
		unset($_SESSION['user_msg']);
	}
?>
<form action="article/create/" method="post">
	<label>Заголовок!</label>
	<br>
	<input type="text" name="title">
	<br>
	<label>Краткое описание</label>
	<br>
	<textarea class="article_short_text" name="short_text"></textarea>
	<br>
	<label>Текст статейки тут</label>
	<br>
	<textarea class="article_fulltext" name="text"></textarea>
	<button type="submit">Создать!</button>
</form>