<?
if(!empty($_SESSION['user_msg']))
	{
		echo $_SESSION['user_msg'];
		unset($_SESSION['user_msg']);
	}
?>

<form action="article/update/" method="post">
	<button class="form_button" type="submit">Сохранить</button>
	<br>
	<input type='hidden' name='id' value="<?= $data['id'] ?>">
	<label>Заголовок!</label>
	<br>
	<textarea class="form_title" name="title">
		<?= $data['title']; ?>
	</textarea>
	<br>
	<label>Краткое описание</label>
	<br>
	<textarea class="form_title" name="short_text">
		<?= $data['short_text']; ?>
	</textarea>
	<br>
	<label>Текст статейки тут</label>
	<br>
	<textarea class="form_text" name="text">
		<?= $data['text']; ?>
	</textarea>
</form>