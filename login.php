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
if(isset($_SESSION['roll'])) {
	$_SESSION['attempted'] = false;
	header("Location: index.php");
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
	$_SESSION['attempted'] = true;
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

$attempted = false;
if(isset($_SESSION['attempted']) && $_SESSION['attempted'])
	$attempted = true;

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>NITT Student DataBase : Login</title>
	<style type="text/css">
	#main {
		position: absolute;
		top: 50%;
		left: 50%;
		transform: translate(-50%,-50%);
		margin-right: 50%;
		border: 1px solid darkgreen;
		border-radius: 10px 10px 0 0;
		padding: 10px;
		min-height: 150px;
		min-width: 350px;
		border-top: none;
	}
	#head {
		padding: 10px;
		margin: -10px -10px 10px -10px;
		border-radius: 10px 10px 0 0;
		background: darkgreen;
		color: white;
		text-align: center;
		font-size: 18px;
		font-family: calibri;
		font-weight: bold;
	}

	label {
		width: 330px;
		float: left;
		display: inline-block;
		margin: 10px;
		font-size: 20px;
	}
	input {
		width: 330px;
		margin: 0 10px 5px 10px;
		padding: 8px;
		border-radius: 2px;
		border:1px solid black;
		
		-webkit-transition: all 0.25s;
		-moz-transition: all 0.25s;
		-o-transtion: all 0.25s;
		-ms-transition: all 0.25s;
		transition: all 0.25s;
	}
	input:focus {
		box-shadow: 0 0 10px 0 #109496;
		-webkit-outline: none;
		-moz-outline: none;
		-o-outline: none;
		-ms-outline: none;
		outline: none;
	}

	#Submit {
		text-decoration: none;
		background: darkgreen;
		box-shadow: 0 0 5px 0 #000;
		border-radius: 5px;
		padding: 10px;
		border: none;
		display: inline-block;
		text-align: center;
		color: white;
		font-weight: bold;
		margin: 30px 10px ;
		width: 350px;

		-webkit-transition: all 0.25s;
		-moz-transition: all 0.25s;
		-o-transtion: all 0.25s;
		-ms-transition: all 0.25s;
		transition: all 0.25s;
	}

	#Submit:hover, #Submit:focus {
		background: blue;
	}

	.error  {
		color: red;
		display: block;
		margin: 10px 10px 0 10px;
		text-align: center;
	}

	</style>
</head>
<body>
	<div id="main">
		<div id="head">NITT Student Database</div>
		<form id="frm" method="post" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>">
			<label for="roll">Roll number</label>
			<input type="text" name="roll" id="roll" autofocus="autofocus">
			<br>

			<label for="pwd">Password</label>
			<input type="password" name="pwd" id="pwd">
			<br>

			<?php 
				if($GLOBALS['attempted'])
					echo "<span class='error'>Wrong roll number or password. <br>Try again.</span>";
			?>

			<input type="submit" value="Login" name="Submit" id="Submit">
		</form>
	</div>
</body>
</html>