<?
$row = $data->fetch();
echo $row['title']."<br>";
echo $row['short_text']."<br>";
echo "<pre>".$row['text']."</pre>"."<br>";
?>