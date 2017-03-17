<script src='https://www.google.com/recaptcha/api.js'></script>
<?
	if(!empty($_SESSION['user_msg']))
		{
			echo "<p>".$_SESSION['user_msg']."</p>";
			unset($_SESSION['user_msg']);
		}
	if ($data['article']['image'] != 'default.svg')
	{
		$dir1 = substr($data['article']['image'], 0, 2)."/";
		$dir2 = substr($data['article']['image'], 2, 2)."/";
	}
	else
	{
		$dir1 = "";
		$dir2 = "";
	}
	$orig = str_replace(".", "_orig.", $data['article']['image']);
?>
<img onclick="closeBigImage()" id="big_image" src="images/<?= $dir1 . $dir2 . $orig ?>">
<img id="base_image" src="images/<?= $dir1 . $dir2 . $data['article']['image'] ?>">
<br>
<i class="fa fa-search-plus" onclick="showBigImage()">Увеличить</i>
<br>
<div id="article">
	<h2 id="article_title">
		<?= $data['article']['title'] ?>
	</h2>
	<div id="article_text">
		<?= $data['article']['text'] ?>
	</div>
</div>

<br>
<br>
<?
if(!empty($_SESSION['id']) and $data['article']['owner_id'] == $_SESSION['id'])
{
	echo "<a href='article/edit/".$data['article']['id']."'>"."Редактировать	</a>";
	if($data['article']['state'] == "draft")
	{
		echo "<a href='article/restore/".$data['article']['id']."'>"."	Опубликовать</a>";
	}
	else
	{
		echo "<a href='article/close/".$data['article']['id']."'>"."	Снять с публикации</a>";	
	}
}
?>
<br>
<br>
<div class="separator_word">Обсуждение:</div>
<br>
<div id="comments">
	
	<? 
	if(empty($data["comments"])) echo "Комментарии отсутствуют!	";

	foreach($data["comments"] as $comment) : ?>
		<div id="username">
			<?= $comment["commenter_name"] ?>
		</div>
		<div id="comment_date">
			 <?= $comment["creation_date"] ?>
		</div>
		<div id="text">
			<?= $comment["text"] ?>
		</div>
		<br>
	<? endforeach; ?>
</div>
<div class="separator_word">Оставить каммент:</div>
<br>
<form id="form_comments" action="article/new_comment/" method="post">
	<?= "<input type='hidden' name='article_id' value='".$data['article']['id']."'>"; ?>
	<input id="commenter_name" type="text" name="commenter_name" placeholder="Представьтесь">
	<br>
	<textarea id="comment_text" name="comment_text" placeholder="Ваш комментарий"></textarea>
	<br>
    <div class="g-recaptcha" data-sitekey="6LfOswoUAAAAAGntCXb1kY6lc6H0LOLQfOpbdyWl"></div>
	<button id="submit_button" type="submit">Добавить!</button>
</form>
<br>