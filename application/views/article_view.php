<?
echo $data['title']."<br>";
echo $data['short_text']."<br>";
echo "<pre>".$data['text']."</pre>"."<br><br>";
echo "<a href='article/edit/".$data['id']."'>"."Редактировать || </a>";
echo "<a href='article/delete/".$data['id']."'>"."Удалить</a>";
?>