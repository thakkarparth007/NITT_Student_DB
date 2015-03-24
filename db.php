<?php
/*
	file: db.php 
description:
	Contains the logic for:
		1. Handling login
		2. Storing the data to the DB.

TODO : 
1. How to authenticate the user?
*/

function get_dept_id($dept) {
	$arr = array("Architecture"								=>	0,
			"Chemical Engineering"							=>	1,
			"Chemistry"										=>	2,
			"Civil Engineering"								=>	3,
			"Computer Applications"							=>	4,
			"Computer Science And Engineering"				=>	5,
			"Electrical And Electronics Engineering"		=>	6,
			"Electronics And Communication Engineering"		=>	7,
			"Humanities"									=>	8,
			"Instrumentation And Control Engineering"		=>	9,
			"Mathematics"									=>	10,
			"Management Studies"							=>	11,
			"Mechanical Engineering"						=>	12,
			"Metallurgy and Materials Science Engineering"	=>	13,
			"Physics"										=>	14,
			"Production Engineering"						=>	15
		);
	return $arr[$dept];
}
function get_course_id($course) {
	$arr = array(
			"B.Tech"	=>	0,
			"B.Arch"	=>	1,
			"M.Tech"	=>	2,
			"MCA"		=>	3,
			"MBA"		=>	4,
			"MS"		=>	5,
			"Phd"		=>	6
		);
	return $arr[$course];
}
function get_dept_name($id) {
	$arr = array("Architecture",
				"Chemical Engineering",
				"Chemistry",
				"Civil Engineering",
				"Computer Applications",
				"Computer Science And Engineering",
				"Electrical And Electronics Engineering",
				"Electronics And Communication Engineering",
				"Humanities",
				"Instrumentation And Control Engineering",
				"Mathematics",
				"Management Studies",
				"Mechanical Engineering",
				"Metallurgy and Materials Science Engineering",
				"Physics",
				"Production Engineering"
			);
	return $arr[$id];
}
function get_course_name($id) {
	$arr = array("B.Tech",
				 "B.Arch",
				 "M.Tech",
				 "MCA",
				 "MBA",
				 "MS",
				 "Phd"
			);
	return $arr[$id];
}

function connect() {
	return mysqli_connect(get_host(), get_username(), get_password(), get_db());
}

function insert_in_db($data) {
	$link = connect();
	$data['course'] = get_course_id($data['course']);
	$data['dept'] = get_dept_id($data['dept']);

	$query = "INSERT INTO students ";
	$fields = [];
	$values = [];
	$update = [];
	foreach($data as $key => $value) {
		$fields[]= "`$key`";
		$values[]= "'" . mysqli_real_escape_string($link, $value) . "'";

		if($key != 'roll')
			$update[] = "`$key`=VALUES(`$key`)"; 
	}

	$fields = join(", ", $fields);
	$values = join(", ", $values);
	$update = join(", ", $update);

	$query .= "($fields) VALUES ($values) ON DUPLICATE KEY UPDATE $update;";
	return mysqli_query($link, $query);
}

function load_data($roll) {
	$link = connect();
	$query = "SELECT * FROM students WHERE roll='" . mysqli_real_escape_string($link, $roll) . "';";
	$result = mysqli_query($link, $query);
	$old_data = mysqli_fetch_assoc($result);

	if($old_data) {
		$old_data['roomno'] = explode(", ", $old_data['hostel'])[0];
		$old_data['hostel'] = explode(", ", $old_data['hostel'])[1];
		$old_data['dept'] = get_dept_name($old_data['dept']);
		$old_data['course'] = get_course_name($old_data['course']);
		$old_data['donate'] = $old_data['donate'] == "Y" ? "Yes" : "No";
	}
	return $old_data;
}
?>