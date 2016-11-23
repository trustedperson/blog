<!-- <a class="content_button" href="/todo" data-section="todo">todo app</a> -->
<!-- <a class="content_button" href="/main" data-section="wordpress">WP</a> -->
<a href="article/new/">СОЗДАТЬ</a>
<br>
<?
while($row = $data->fetch())
	{
		echo "<a href='article/read/".$row['id']."'>".$row['title']."<a/>"."<br>";
		echo $row['short_text'];
		echo "<br><br>";
	}

if(!empty($_SESSION['user_msg']))
	{
		echo $_SESSION['user_msg'];
		unset($_SESSION['user_msg']);
	}