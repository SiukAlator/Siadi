<?php
	include_once dirname(__FILE__) . '/Config.php';
	if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
		$uri = 'https://';
	} else {
		$uri = 'http://';
	}
	session_start();
	if (!isset($_SESSION['TOKEN']))
	{
		$uri .= $_SERVER['HTTP_HOST'];
		header('Location: '.$uri.URL_SADMIN.'/login');
		exit;
	}
	else {
		//TODO
		$uri .= $_SERVER['HTTP_HOST'];
		header('Location: '.$uri.URL_SADMIN.'/dashboard.php');
		exit;
	}

?>
