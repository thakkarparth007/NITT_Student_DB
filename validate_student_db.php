<?php
/* 
file: validate_student_db.php 
description:
	Contains the logic for the backend validation of the data.
	Only one "public" method - validate(). Uses the data from the 
	$_POST array (assuming that the form has been submitted already)
	and returns a json string of the form:
	{
		status: "success" or "error",
		if success, then for each data-field, returns a string containing the error
		description for that field, or false - indicating no error
	}

TODO : finish the validation functions.
		push stuff in the db
		login page
		check if roomno,hostel errors are managed properly
*/

$max_photo_size = 1048576;	// 1 MB
$upload_required = true;
$upload_dir = "C:/wamp/www/student_db/images/";
$mime_images = array("image/jpeg", "image/pjpeg", "image/png");

function _validate_name($name) {
	if(strlen($name) > 50)
		return ["Name can not exceed 50 characters",false];
	if(!preg_match("/^[a-zA-Z \.']+$/", $name))
		return ["Enter a valid name",false];

	return [false, $name];
}
function _validate_email($email) {
	if(!preg_match("/^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/", $email))
		return ["Enter a valid email id",false];

	return [false,$email];
}
function _validate_contact($contact) {
	if(!preg_match("/^[0\+]\d{12,13}$/", $contact))
		return ["Enter a valid 10 digit or 11 digit mobile number",$contact];

	return [false,$contact];
}


function validate_name() {
	$name = sanitize_input($_POST['name']);
	return _validate_name($name);
}
function validate_roll() {
	$roll = sanitize_input($_POST['roll']);
	
	// ??
	if(!preg_match("/^\d{9}$/", $roll))
		return ["Enter a valid roll number",false];

	// validate with database
	
	return [false,$roll];
}
function validate_course() {
	$course = sanitize_input($_POST['course']);

	if(!preg_match("/^B\.Tech|B\.Arch|M\.Tech|MCA|MBA|MS|Phd$/", $course))
		return ["Choose a valid course",false];

	return [false, $course];
}
function validate_dept() {
	$dept = sanitize_input($_POST['dept']);
	$re = "/^Architecture|Chemical Engineering|Chemistry|Civil Engineering|Computer Applications|Computer Science And Engineering|Electrical And Electronics Engineering|Electronics And Communication Engineering|Humanities|Instrumentation And Control Engineering|Mathematics|Management Studies|Mechanical Engineering|Metallurgy and Materials Science Engineering|Physics|Production Engineering$/";
	if(!preg_match($re, $dept))
		return ["Choose a valid department", false];

	return [false,$dept];
}
function validate_dob() {
	$dob = sanitize_input($_POST['dob']);
	
	$dob = new DateTime($dob);
	if(!$dob)
		return ["Enter a valid date of birth",false];

	// ??
	if($dob->getTimeStamp() < strtotime("1 Jan 1930"))
		return ["Enter a valid date of birth",false];

	$lower_bound = new DateTime();
	$lower_bound = $lower_bound->sub( date_interval_create_from_date_string("17 years") );

	if($dob->getTimeStamp() > $lower_bound->getTimeStamp())
		return ["Enter a valid date of birth",false];

	return [false,$dob];
}
function validate_roomno() {
	$roomno = sanitize_input($_POST['roomno']);

	if(!preg_match("/^\d+$/",$roomno)) 
		return ["Enter a valid room number", false];

	return [false,$roomno];
}
// if successful, returns something like : [false, "29 Coral"]
function validate_hostel() {
	$hostel_error = false;
	$room_error = false;

	$roomno = sanitize_input($_POST['roomno']);
	if(!preg_match("/^\d+$/",$roomno)) 
		$room_error = true;

	$hostel = sanitize_input($_POST['hostel']);
	$re = "/^Coral|Agate|Diamond|Jade|Zircon A|Zircon B|Zircon C|Garnet A|Garnet B|Garnet C|Amber A|Amber B|Perl|Ruby|Sapphire|Emerald|Topaz|Aquamarine A|Aquamarine B|Jasper|Opal A|Opal B|Opal C|Opal D|Opal E$/";
	if(!preg_match($re, $hostel))
		$hostel_error = true;

	$err = "Enter a valid";
	if($hostel_error && $room_err)
		$err .= " room number and hostel";
	else if($hostel_error)
		$err .= " hostel";
	else if($room_error)
		$err .= " room number";
	else
		return [false, $roomno . ", " . $hostel];

	return [$err,false];
}
// careful with the return value!
function validate_photo() {
	//$photo = sanitize_input($_POST['photo']);
	$file = $_FILES["photo"];

	if(!isset($_FILES["photo"])) {
		return "The photo is required";
	}

	switch($file['error']) {
		case UPLOAD_ERR_INI_SIZE:
			return "The uploaded image is too large";
		case UPLOAD_ERR_PARTIAL:
			return "The upload wasn't successfull. Please retry";
		case UPLOAD_ERR_NO_FILE:
			return "The photo is required";
		case UPLOAD_ERR_FORM_SIZE:
			return "The uploaded file is too large according to MAX_FIELD_SIZE";
		case UPLOAD_ERR_OK:
			break;

		default:
			return "An unknown error occurred. Please retry1";
	}

	if(!in_array($file['type'], $GLOBALS["mime_images"])) {
		return "Only images may be uploaded";
	}
	// ??
	return false;
}


// page 2
function validate_email() {
	$email = sanitize_input($_POST['email']);
	return _validate_email($email);
}
function validate_contact() {
	$contact = sanitize_input($_POST['contact1']);
	return _validate_contact($contact);
}
function validate_sec_contact() {
	$sec_contact = sanitize_input($_POST['sec_contact1']);
	return _validate_contact($sec_contact);
}
// careful with return value
function validate_curr_addr() {
	$add1 = sanitize_input($_POST['curr_addr1']);
	$add2 = sanitize_input($_POST['curr_addr2']);
	$add3 = sanitize_input($_POST['curr_addr3']);
	$add4 = sanitize_input($_POST['curr_addr4']);
	$add5 = sanitize_input($_POST['curr_addr5']);
	$country = sanitize_input($_POST['curr_country']);
	
	$err['curr_addr1']
		= $add1 == "" ? ["Address Line 1 is required",false] : [false, $add1];
	$err['curr_addr2'] 
		= $add2 == "" ? ["Address Line 2 is required",false] : [false, $add2];
	$err['curr_addr3']
		= $add3 == "" ? ["City name is required",false] : [false, $add2];
	$err['curr_addr4']
		= $add4 == "" ? ["State name is required",false] : [false, $add3];
	$err['curr_addr5']
		= $add5 == "" ? ["ZIP Code is required",false] : [false, $add4];
	$err['curr_country']
		= $country == "" ? ["Country name is required",false] : [false, $country];

	return $err;
}
// be careful with the return value
// returns false if the country is india
// otherwise, returns the same datatype as returned by validate_curr_addr
function validate_india_addr() {
	$country = sanitize_input($_POST['curr_country']);
	
	if(strtolower($country) == 'india') {
		return false;
	}

	$add1 = sanitize_input($_POST['india_addr1']);
	$add2 = sanitize_input($_POST['india_addr2']);
	$add3 = sanitize_input($_POST['india_addr3']);
	$add4 = sanitize_input($_POST['india_addr4']);
	$add5 = sanitize_input($_POST['india_addr5']);
	
	$err['india_addr1']
		= $add1 == "" ? ["Address Line 1 is required",false] : [false, $add1];
	$err['india_addr2'] 
		= $add2 == "" ? ["Address Line 2 is required",false] : [false, $add2];
	$err['india_addr3']
		= $add3 == "" ? ["City name is required",false] : [false, $add2];
	$err['india_addr4']
		= $add4 == "" ? ["State name is required",false] : [false, $add3];
	$err['india_addr5']
		= $add5 == "" ? ["ZIP Code is required",false] : [false, $add4];

	return $err;
}

function validate_nationality() {
	$nationality = sanitize_input($_POST['nationality']);
	
	if($nationality == "") 
		return ["Nationality is required", false];
	
	return [false, $nationality];
}


//page 3
function validate_father_name() {
	$name = sanitize_input($_POST['father_name']);
	return _validate_name($name);
}
function validate_father_email() {
	$email = sanitize_input($_POST['father_email']);
	return _validate_email($email);
}
function validate_father_contact() {
	$contact = sanitize_input($_POST['father_contact1']);
	return _validate_contact($contact);
}
function validate_mother_name() {
	$name = sanitize_input($_POST['mother_name']);
	return _validate_name($name);
}
function validate_mother_email() {
	$email = sanitize_input($_POST['mother_email']);
	return _validate_email($email);
}
function validate_mother_contact() {
	$contact = sanitize_input($_POST['mother_contact1']);
	return _validate_contact($contact);
}
function validate_emergency_name() {
	$name = sanitize_input($_POST['emergency_name']);
	return _validate_name($name);
}
function validate_emergency_relation() {
	$rel = sanitize_input($_POST['emergency_relation']);

	if($rel == "")
		return ["Emergency Contact Relation is required",false];
	return [false,$rel];
}
function validate_emergency_contact() {
	$contact = sanitize_input($_POST['emergency_contact1']);
	return _validate_contact($contact);
}


function move_photo() {
	$file = $_FILES['photo'];
	$roll = sanitize_input($_POST['roll']);
	
	$upload_dir = $GLOBALS['upload_dir'];
	if(!@move_uploaded_file($file['tmp_name'], $upload_dir . $roll . "-" . $file['name'])) {
		return "An unknown error occurred. Please retry2";
	}
}

function sanitize_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

function validate() {
	$err = array();
	$err['name'] 		= validate_name();
	$err['roll'] 		= validate_roll();
	$err['course'] 		= validate_course();
	$err['dept'] 		= validate_dept();
	$err['dob'] 		= validate_dob();
	$err['hostel'] 		= validate_hostel();
	$err['photo'] 		= validate_photo();

	// page 2
	$err['email']		= validate_email();
	$err['contact'] 	= validate_contact();
	$err['sec_contact'] = validate_sec_contact();

	// curr_addr
	$curr_addr_err = validate_curr_addr();
	foreach ($curr_addr_err as $key => $value) {
		$err[$key] = $value;
	}
	$india_addr_err = validate_india_addr();
	if($india_addr_err) {
		foreach ($india_addr_err as $key => $value) {
			$err[$key] = $value;
		}
	}
	$err['nationality'] = validate_nationality();

	// page 3
	$err['father_name'] 	= validate_father_name();
	$err['father_email'] 	= validate_father_email();
	$err['father_contact'] 	= validate_father_contact();
	$err['mother_name'] 	= validate_mother_name();
	$err['mother_email'] 	= validate_mother_email();
	$err['mother_contact'] 	= validate_mother_contact();
	$err['emergency_name'] 	= validate_emergency_name();
	$err['emergency_relation'] 	= validate_emergency_relation();
	$err['emergency_contact'] 	= validate_emergency_contact();

	$prob = false;
	foreach($err as $name => $val) {
		if($val[0]) {
			$prob = true;
			break;
		}
	}

	if(!$prob) {
		$err["status"] = "success";
		// move the photo only if everything else was successful.
		move_photo();
		header('Location: success.php');
	}
	else
		$err["status"] = "error";

	$err_to_be_shown = [];
	foreach ($err as $key => $value) {
		$err_to_be_shown[$key] = $val[0];
	}
	$err_to_be_shown = json_encode($err_to_be_shown);
	return $err_to_be_shown;
}

?>