<?
if(!empty($_SESSION['user_msg']))
	{
		"<p>".$_SESSION['user_msg']."</p>";
		unset($_SESSION['user_msg']);
	}
echo $data['article']['title']."<br>";
echo $data['article']['short_text']."<br>";
echo "<pre>".$data['article']['text']."</pre>"."<br><br>";
echo "<a href='article/edit/".$data['article']['id']."'>"."Редактировать || </a>";
echo "<a href='article/delete/".$data['article']['id']."'>"."Удалить</a>";
?>
<br>
<br>
<br>
<?
$i = 0;
while(isset($data['comments'][$i]['id']))
{
	echo $data['comments'][$i]['text'];
	$i++;
}
?>