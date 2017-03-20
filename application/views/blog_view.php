<?
if(!empty($_SESSION['user_msg']))
	{
		echo $_SESSION['user_msg'];
		unset($_SESSION['user_msg']);
	}


foreach ($data as $row) :?>
	<div class="item">
		<img class="thumbnail" src="<?= $row["image"] ?>">
		<a href="article/read/<?= $row['id'] ?>">
			<?= $row['title'] ?>
		</a>
		<br>
		<div class="article_date">
			<?= $row["creation_date"] ?>
		</div>
		<br>
			<?= $row['short_text'] ?>
		<br>
		<br>
		<br>
	</div>

<?	endforeach ?>