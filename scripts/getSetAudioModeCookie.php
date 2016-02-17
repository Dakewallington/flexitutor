<?PHP
	
	if($_GET['requset'] == 'create')
	{
		setcookie('audioModeCookie', true, time() + 86400);
	}
	
	if($_GET['requset'] == 'remove')
	{
		setcookie('audioModeCookie', '', time() - 86400);
	}
	
	if(isset($_COOKIE['audioModeCookie']) && $_COOKIE['audioModeCookie'] == true)
	{
		echo 'true';	
	}
	else
	{
		echo 'false';
	}
	
?>