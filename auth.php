<?php

session_start();

function authenticate() {
	if(!$_SESSION['roll'])
		header("Location: login.php");

	return true;
}

function force_logout() {
	$_SESSION = array();

	if(ini_get("session.use_cookies")) {
		$params = session_get_cookie_params();
		setcookie(session_name(), '', time() - 160000,
				$params['path'], $params['domain'],
				$params['secure'], $params['httponly']);
	}

	session_destroy();
	header("Location: login.php");
}

?>