<?
if(!empty($_SESSION['user_msg']))
	{
		echo $_SESSION['user_msg'];
		unset($_SESSION['user_msg']);
	}
?>
<form action="article/create/" enctype="multipart/form-data" method="post">
	<button class="form_button" type="submit">Создать!</button>
	<br>
	<input class="form_title" type="text" name="title" placeholder="Заголовок" autocomplete="off" autofocus="on">
	<br>
	<textarea class="form_text" name="text" placeholder="Печатай тут" autocomplete="off"></textarea>
	<br>
    Отправить этот файл: <input class="form_imageload" name="image" type="file" />
	
</form>