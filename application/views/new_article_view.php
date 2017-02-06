<?
if(!empty($_SESSION['user_msg']))
	{
		echo $_SESSION['user_msg'];
		unset($_SESSION['user_msg']);
	}
?>
<form action="article/create/" enctype="multipart/form-data" method="post">
	<label>Заголовок!</label>
	<br>
	<input type="text" name="title">
	<br>
	<label>Текст статейки тут</label>
	<br>
	<textarea class="article_fulltext" name="text"></textarea>
	<br>
    Отправить этот файл: <input name="image" type="file" />
	<button type="submit">Создать!</button>
</form>