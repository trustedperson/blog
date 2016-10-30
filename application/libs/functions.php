<?
// for common use
function go_Url($url) {
	$host = 'https://'.$_SERVER['HTTP_HOST'].'/';
		//header('HTTPS/1.1 404 Not Found');
	// header("Status: 404 Not Found");
	header('Location:'.$host.$url);
	exit;
}

// sessions
function session_exists() {
		if(!empty($_SESSION['id']) or !empty($_SESSION['email'])) {
			return true;
		}
		return false;
	}

function errorPage404()
	{
        $host = 'https://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTPS/1.1 404 Not Found');
		header("Status: 404 Not Found");
		header('Location:'.$host.'404');
    }