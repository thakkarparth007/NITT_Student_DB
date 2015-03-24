<?php

function sanitize_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

function validate_credentials($roll, $pwd) {
	return ($roll == '106114062' && $pwd == 'password');
}

session_start();
if(isset($_SESSION['roll']))
	header("Location: index.php");

$success = false;
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	$roll = sanitize_input($_POST['roll']);
	$pwd = sanitize_input($_POST['pwd']);

	$success = validate_credentials($roll, $pwd);
	if($success)
	{
		session_start();
		session_regenerate_id(true);
		$_SESSION['roll'] = $roll;
		header("Location: index.php");
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>NITT Student DataBase : Login</title>
</head>
<body>
	<form id="frm" method="post" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>">
		<label for="roll">Roll number</label>
		<input type="text" name="roll" id="roll">
		<br>

		<label for="pwd">Password</label>
		<input type="password" name="pwd" id="pwd">
		<br>

		<span style="color: red">
		<?php
			if(!$GLOBALS['success']) {
				echo "Wrong combination of roll number and password. Please try again.";
			}
		?>
		</span>

		<input type="submit" value="Login" name="submit" id="submit">
	</form>
</body>
</html>