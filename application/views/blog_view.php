<?
if(!empty($_SESSION['user_msg']))
	{
		echo $_SESSION['user_msg'];
		unset($_SESSION['user_msg']);
	}

foreach ($data as $row)
	{ ?>
	<div class="item">
		<a href="article/read/<?= $row['id'] ?>">
			<?= $row['title'] ?>
		</a>
		<br>
		<?= $row['short_text'] ?>
		<br>
		<br>
		<br>
	</div>
<?	} ?>