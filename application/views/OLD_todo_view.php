<div>
<p>
	Создать запись:
</p>
<form action="/todo/create" method="post">
<input type="text" name="task" autocomplete="off" autofocus>
<input type="submit" value="Create!">
</form>
	<?
		$i=0;
		foreach ($data as $task)
		{
			echo $task->serial_number.": ".$task->task."; ".a_href("/todo/edit/$task->serial_number", "Редактировать").":: "."<form class=\"del_btn\"><button name=\"serial_number\" type=\"submit\" formmethod=\"post\" formaction=\"/todo/delete\" value=\"$task->serial_number\">DEL</button></form>"."<br>";
		}
	?>
</div>