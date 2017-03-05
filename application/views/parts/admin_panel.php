<div id='admin_panel'>
	<a href='profile'><? echo $_SESSION['first_name'] . " " . $_SESSION['last_name'] . " (Профиль)"?></a><br>
	<a href='profile/moderation'>Модерация</a><br><br>
	<form><button formaction='login/exit/'> Выход здесь</button></form>
</div>