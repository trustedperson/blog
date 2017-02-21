<?
if(!empty($_SESSION['user_msg']))
	{
		echo $_SESSION['user_msg'];
		unset($_SESSION['user_msg']);
	}
?>
<?
foreach ($data as $row)
	{
		echo "<a href='article/read/".$row['id']."'>".$row['title']."</a>"."<br>";
		echo $row['short_text']."<br>";
		echo "<br><br>";
	}