<?
class Controller_Test extends Controller
{
	function action_index()
	{
		echo "test"."<br>";
		echo IMAGETYPE_GIF . "<br>";
		var_dump(IMAGETYPE_GIF)."<br>";		
	}
} 