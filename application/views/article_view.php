<script src='https://www.google.com/recaptcha/api.js'></script>
<?
if(!empty($_SESSION['user_msg']))
	{
		echo "<p>".$_SESSION['user_msg']."</p>";
		unset($_SESSION['user_msg']);
	}
if ($data['article']['image'] != 'default.png')
{
	$dir1 = substr($data['article']['image'], 0, 2)."/";
	$dir2 = substr($data['article']['image'], 2, 2)."/";
}
else
{
	$dir1 = "";
	$dir2 = "";
}
echo $data['article']['title']."<br>";
echo "<img src='images/". $dir1 . $dir2 . $data['article']['image'] . "'><br>";
echo $data['article']['short_text']."<br>";
echo "<pre>".$data['article']['text']."</pre>"."<br><br>";
if(!empty($_SESSION['id']) and $data['article']['owner_id'] == $_SESSION['id'])
{
	echo "<a href='article/edit/".$data['article']['id']."'>"."Редактировать || </a>";
	if($data['article']['state'] == "draft")
	{
		echo "<a href='article/restore/".$data['article']['id']."'>"."Опубликовать</a>";
	}
	else
	{
		echo "<a href='article/close/".$data['article']['id']."'>"."Снять с публикации</a>";	
	}
}
?>
<br>
<br>
<form action="article/new_comment/" method="post">
	<?
	echo "<input type='hidden' name='article_id' value='".$data['article']['id']."'>";
	?>
	<label>Представьтесь:</label>
	<br>
	<input type="text" name="commenter_name">
	<br>
	<label>Ваш комментарий:</label>
	<br>
	<textarea class="comment_text" name="comment_text"></textarea>
	<button type="submit">Добавить!</button>
	<br>
        <div class="g-recaptcha" data-sitekey="6LfOswoUAAAAAGntCXb1kY6lc6H0LOLQfOpbdyWl">
        </div>
</form>
<br>
<?
$i = 0;
while(isset($data['comments'][$i]['id']))
{
	echo $data['comments'][$i]['commenter_name']."<br>";
	echo $data['comments'][$i++]['text']."<br>";
}
?>
