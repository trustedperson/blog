<?
// for common use
function go_Url($url)
{
	$host = 'https://'.$_SERVER['HTTP_HOST'].'/';
	header('Location:'.$host.$url);
	exit;
}

function errorPage404()
	{
        $host = 'https://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTPS/1.1 404 Not Found');
		header("Status: 404 Not Found");
		header('Location:'.$host.'404');
    }

function httpPost($url, $data)
{
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}

// sessions
function reject_if_not_logged_in($url = 'main')
{
	if (!has_login()) 
			{
				$_SESSION['last_page'] = $_SERVER['REQUEST_URI'];
				$_SESSION['user_msg'] = "Вы не авторизованы!";
				go_Url($url);
			}
}

function has_login()
{
		if(!empty($_SESSION['id']) or !empty($_SESSION['email'])) {
			return true;
		}
		return false;
	}