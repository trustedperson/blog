<?
class View
{
	//public $template_view; // здесь можно указать общий вид по умолчанию.
	
	function generate($content_view = null, $template_view, $data = null)
	{
		include '../application/views/'.$template_view;
	}
}