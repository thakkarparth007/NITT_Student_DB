<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . "db.php";
require_once __DIR__ . DIRECTORY_SEPARATOR . "auth.php";

authenticate();

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
	div#message {
		position: absolute;
		top: 50%;
		transform: translate(0,-50%);
		color: green;
		text-shadow: 0 0 10px #000;
		font-size: 100px;
		font-family: calibri;
		-webkit-transition: all 0.5s;
		-moz-transition: all 0.5s;
		-o-transtion: all 0.5s;
		-ms-transition: all 0.5s;
		transition: all 0.5s;
		text-align: center;
		left: 0;
		right: 0;
	}
	#link_container {
		max-width: 600px;
		margin: 0 auto;
	}
	a {
		text-decoration: none;
		font-size: 20px;
		background: darkgreen;
		color: white;
		font-weight: bold;
		padding: 10px;
		width: 250px;
		margin: 10px;
		display: block;
		float: left;
		border-radius: 5px;
	}

	@media(max-width: 600px) {
		#link_container {
			position: absolute;
			left: 50%;
			transform: translate(-50%,0);
			margin-right: 50%;
		}
	}
	</style>
</head>
<body>
	<div id="message">

		Thank you
		<div id="link_container">
			<a href="./">Go back to edit details</a>
			<a href="./logout.php">Log out</a>
			<br style="clear: both">
		</div>
	</div>
</body>
</html>