<script src='https://www.google.com/recaptcha/api.js'></script>
<?
	if(!empty($_SESSION['user_msg']))
		{
			echo "<p id='user_msg'>".$_SESSION['user_msg']."</p>";
			unset($_SESSION['user_msg']);
		}
	
	$orig = str_replace(".", "_orig.", $data['article']['image']);
?>
<img onclick="closeBigImage()" id="big_image" src="<?= $orig ?>">
<img id="base_image" src="<?= $data['article']['image'] ?>" onclick="showBigImage()">
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
<div class="separator">Обсуждение:</div>
<br>
<div id="comments">
	
	<? 
	if(empty($data["comments"])) echo "А комментов то нет...";

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
<div class="separator">Оставить каммент:</div>
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