<?
if(!empty($_SESSION['user_msg']))
	{
		echo $_SESSION['user_msg']."<br>";
		unset($_SESSION['user_msg']);
	}
?>
<a href="article/new/">Создать</a>
<br>
<?
while($row = $data->fetch())
	{
		include "../application/views/parts/my_articles_row.php";
	}