<?
if(!empty($_SESSION['user_msg']))
	{
		echo $_SESSION['user_msg'];
		unset($_SESSION['user_msg']);
	}

foreach ($data as $row)
	{
		include "../application/views/parts/blog_row.php";
	}