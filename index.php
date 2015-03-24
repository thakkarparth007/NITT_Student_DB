<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . "db.php";
require_once __DIR__ . DIRECTORY_SEPARATOR . "auth.php";
require_once __DIR__ . DIRECTORY_SEPARATOR . "validate_student_db.php";

authenticate();

$err = "{}";

if($_SERVER['REQUEST_METHOD'] == 'POST') {
	// a json string that contains the errors and 
	// a status message (success/error)
	$err = validate();
}
else {
	$old_data = load_data($_SESSION['roll']);
	if($old_data) {
		$old_data['status'] = 'success';
		$err = json_encode($old_data);
	}
	else {
		$err = "{}";
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>NITT Student DataBase</title>
	<link rel="stylesheet" type="text/css" href="student_db_css/main.css">
	<link rel="stylesheet" type="text/css" media="(max-width:600px)" href="student_db_css/main_vsmall.css">
	<link rel="stylesheet" href="js/intl-tel-input/build/css/intlTelInput.css">
</head>
<body>
	<div id="error_message">
		<span id="error_message_text">
			There are errors in the form you submitted. Please make the necessary corrections. 

			<br><br>

			Click this box to dismiss this message.
		</span>
	</div>
	<div id="tabContainer">
		<div id="top_bar">
			<div id="message">
				National Institute of Technology Tiruchirappalli Student Database (For official use only). Please fill out the form carefully.
			</div>

			<a id="logout" href="logout.php">Logout</a>
			<br class="clear">
		</div>
	
		<div id="tabWrapper">
			<a href="#part1" id="link_p1" class="tab active">Part 1<span class="exxtra"> : Academic</span> <span class="extra">Details</span></a>
			<a href="#part2" id="link_p2" class="tab">Part 2<span class="exxtra"> : Contact</span> <span class="extra">Details</span></a>
			<a href="#part3" id="link_p3" class="tab">Part 3<span class="exxtra"> : Emergency</span> <span class="extra">Details</span></a>
		</div>
	</div>
	
	<!-- First form -->
	<form id="frm" enctype="multipart/form-data" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
	<div id="page1" class="page">
		<p>
			<label for="name">Full Name</label>
			<input type="text" name="name" id="name">
			<span id="succname" class="success">✓ Valid</span><span id="errname" class="error"></span>
		</p>
		<br>

		<p>
			<label for="roll">Roll Number</label>
			<input type="text" name="roll" id="roll">
			<span id="succroll" class="success">✓ Valid</span><span id="errroll" class="error"></span>
		</p>
		<br>

		<p>
			<label for="course">Course</label>
			<select id="course" name="course">
				<option>Select...</option>
				<option>B.Tech</option>
				<option>B.Arch</option>
				<option>M.Tech</option>
				<option>MCA</option>
				<option>MBA</option>
				<option>MS</option>
				<option>Phd</option>
			<select>
			<span id="succcourse" class="success">✓ Valid</span><span id="errcourse" class="error"></span>
		</p>
		<br>

		<p>
			<label for="dept">Department</label>
			<select class="input" id="dept" name="dept">
				<option>Select...</option>
				<option>Architecture</option>
				<option>Chemical Engineering</option>
				<option>Chemistry</option>
				<option>Civil Engineering</option>
				<option>Computer Applications</option>
				<option>Computer Science And Engineering</option>
				<option>Electrical And Electronics Engineering</option>
				<option>Electronics And Communication Engineering</option>
				<option>Humanities</option>
				<option>Instrumentation And Control Engineering</option>
				<option>Mathematics</option>
				<option>Management Studies</option>
				<option>Mechanical Engineering</option>
				<option>Metallurgy and Materials Science Engineering</option>
				<option>Physics</option>
				<option>Production Engineering</option>
			</select>

			<span id="succdept" class="success">✓ Valid</span><span id="errdept" class="error"></span>
		</p>
		<br>

		<p>
			<label for="dob">Date of birth</label>
			<input type="date" name="dob" id="dob">
			<span id="succdob" class="success">✓ Valid</span><span id="errdob" class="error"></span>
		</p>
		<br>

		<p>
			<label for="hostel">Hostel</label>
			<input type="number" name="roomno" id="roomno" placeholder="Room number">
			<select name="hostel" id="hostel">
				<option>Select...</option>
				<option>Coral</option>
				<option>Agate</option>
				<option>Diamond</option>
				<option>Jade</option>
				<option>Zircon A</option>
				<option>Zircon B</option>
				<option>Zircon C</option>
				<option>Garnet A</option>
				<option>Garnet B</option>
				<option>Garnet C</option>
				<option>Amber A</option>
				<option>Amber B</option>
				<option>Perl</option>
				<option>Ruby</option>
				<option>Sapphire</option>
				<option>Emerald</option>
				<option>Topaz</option>
				<option>Aquamarine A</option>
				<option>Aquamarine B</option>
				<option>Jasper</option>
				<option>Opal A</option>
				<option>Opal B</option>
				<option>Opal C</option>
				<option>Opal D</option>
				<option>Opal E</option>
			</select>
			<span id="succhostel" class="success">✓ Valid</span><span id="errhostel" class="error"></span>
		</p>
		<br>

		<p>
			<label for="photo">Photo</label>
			<input type="file" name="photo" id="photo">
			<span id="succphoto" class="success">✓ Valid</span><span id="errphoto" class="error"></span>
		</p>
		<br>
	</div>
	<div id="page2" class="page">
		<p>
			<label for="email">Email</label>
			<input type="email" name="email" id="email">
			<span id="succemail" class="success">✓ Valid</span><span id="erremail" class="error"></span>
		</p>
		<br>

		<p>
			<label for="contact">Contact</label>
			<input type="tel" name="contact" id="contact">
			<span id="succcontact" class="success">✓ Valid</span><span id="errcontact" class="error"></span>
		</p>
		<br>

		<p>
			<label for="sec_contact">Secondary Contact</label>
			<input type="tel" name="sec_contact" id="sec_contact">
			<span id="succsec_contact" class="success">✓ Valid</span><span id="errsec_contact" class="error"></span>
		</p>
		<br>


		<hr>
		<p class="info_group_label">
			Current Residential Address
		</p>
		<p>
			<label for="curr_addrline1">Address Line 1</label>
			<input name="curr_addrline1" id="curr_addrline1">
			<span id="succcurr_addrline1" class="success">✓ Valid</span><span id="errcurr_addrline1" class="error"></span>
			<br>

			<label for="curr_addrline2">Address Line 2</label>
			<input name="curr_addrline2" id="curr_addrline2">
			<span id="succcurr_addrline2" class="success">✓ Valid</span><span id="errcurr_addrline2" class="error"></span>
			<br>

			<label for="curr_city">City</label>
			<input name="curr_city" id="curr_city">
			<span id="succcurr_city" class="success">✓ Valid</span><span id="errcurr_city" class="error"></span>
			<br>
			
			<label for="curr_state">State/Region/Province</label>
			<input name="curr_state" id="curr_state">
			<span id="succcurr_state" class="success">✓ Valid</span><span id="errcurr_state" class="error"></span>
			<br>

			<label for="curr_zip">ZIP/Postal Code</label>
			<input name="curr_zip" id="curr_zip">
			<span id="succcurr_zip" class="success">✓ Valid</span><span id="errcurr_zip" class="error"></span>
			<br>
			
			<label for="curr_country">Country</label>
			<input type="text" name="curr_country" id="curr_country" value="India">
			<span id="succcurr_country" class="success">✓ Valid</span><span id="errcurr_country" class="error"></span>
		</p>
		<br>

		<hr>
		<p id="p_india_addr_label" class="info_group_label">
			Residential Address in India
		</p>
		<p id="p_india_addr">
			<label for="india_addrline1">Address Line 1</label>
			<input name="india_addrline1" id="india_addrline1">
			<span id="succindia_addrline1" class="success">✓ Valid</span><span id="errindia_addrline1" class="error"></span>
			<br>

			<label for="india_addrline2">Address Line 2</label>
			<input name="india_addrline2" id="india_addrline2">
			<span id="succindia_addrline2" class="success">✓ Valid</span><span id="errindia_addrline2" class="error"></span>
			<br>

			<label for="india_city">City</label>
			<input name="india_city" id="india_city">
			<span id="succindia_city" class="success">✓ Valid</span><span id="errindia_city" class="error"></span>
			<br>
			
			<label for="india_state">State/Region/Province</label>
			<input name="india_state" id="india_state">
			<span id="succindia_state" class="success">✓ Valid</span><span id="errindia_state" class="error"></span>
			<br>

			<label for="india_zip">ZIP/Postal Code</label>
			<input name="india_zip" id="india_zip">
			<span id="succindia_zip" class="success">✓ Valid</span><span id="errindia_zip" class="error"></span>
			<br>
		</p>
		<br>

		<hr id="hr_following_india_addr">
		<p>
			<label for="nationality">Nationality</label>
			<input type="text" name="nationality" id="nationality" value="Indian">
			<span id="succnationality" class="success">✓ Valid</span><span id="errnationality" class="error"></span>
		</p>
		<br>
	</div>
	<div id="page3" class="page">
		<p class="info_group_label">
			Father's details
		</p>
		<p>
			<label for="father_name">Name</label>
			<input type="text" name="father_name" id="father_name">
			<span id="succfather_name" class="success">✓ Valid</span><span id="errfather_name" class="error"></span>
		</p>
		<br>

		<p>
			<label for="father_email">Email Id</label>
			<input type="email" name="father_email" id="father_email">
			<span id="succfather_email" class="success">✓ Valid</span><span id="errfather_email" class="error"></span>
		</p>
		<br>

		<p>
			<label for="father_contact">Contact</label>
			<input type="tel" name="father_contact" id="father_contact">
			<span id="succfather_contact" class="success">✓ Valid</span><span id="errfather_contact" class="error"></span>
		</p>
		<br>

		<hr>
		<p class="info_group_label">
			Mother's details
		</p>
		<p>
			<label for="mother_name">Name</label>
			<input type="text" name="mother_name" id="mother_name">
			<span id="succmother_name" class="success">✓ Valid</span><span id="errmother_name" class="error"></span>
		</p>
		<br>

		<p>
			<label for="mother_email">Email Id</label>
			<input type="email" name="mother_email" id="mother_email">
			<span id="succmother_email" class="success">✓ Valid</span><span id="errmother_email" class="error"></span>
		</p>
		<br>

		<p>
			<label for="mother_contact">Contact</label>
			<input type="tel" name="mother_contact" id="mother_contact">
			<span id="succmother_contact" class="success">✓ Valid</span><span id="errmother_contact" class="error"></span>
		</p>
		<br>


		<hr>
		<p class="info_group_label">
			Emergency Contact details
		</p>
		<p>
			<label for="emergency_name">Name</label>
			<input type="text" name="emergency_name" id="emergency_name">
			<span id="succemergency_name" class="success">✓ Valid</span><span id="erremergency_name" class="error"></span>
		</p>
		<br>

		<p>
			<label for="emergency_contact">Contact</label>
			<input type="tel" name="emergency_contact" id="emergency_contact">
			<span id="succemergency_contact" class="success">✓ Valid</span><span id="erremergency_contact" class="error"></span>
		</p>
		<br>

		<p>
			<label for="emergency_relation">Relation</label>
			<input type="text" name="emergency_relation" id="emergency_relation">
			<span id="succemergency_relation" class="success">✓ Valid</span><span id="erremergency_relation" class="error"></span>
		</p>
		<br>

		<hr>
		<p>
			<label for="bloodgrp">Your blood group?</label>
			<select name="bloodgrp" id="bloodgrp">
				<option>Select...</option>
				<option>A+</option>
				<option>A-</option>
				<option>O+</option>
				<option>O-</option>
				<option>B+</option>
				<option>B-</option>
				<option>AB+</option>
				<option>AB-</option>
				<option>A1+</option>
				<option>A1-</option>
				<option>A2+</option>
				<option>A2-</option>
				<option>A1B+</option>
				<option>A1B-</option>
				<option>A2B+</option>
				<option>A2B-</option>
				<option>B1+</option>
			</select>
			<span id="succbloodgrp" class="success">✓ Valid</span><span id="errbloodgrp" class="error"></span>
		</p>
		<br>
		<p>
			<label for="donate">Are you willing to donate blood?</label>
			<select name="donate" id="donate">
				<option>Select...</option>
				<option>Yes</option>
				<option>No</option>
			</select>
			<span id="succdonate" class="success">✓ Valid</span><span id="errdonate" class="error"></span>
		</p>
		<br>

	</div>
		<!-- Max size of the file? -->
		<input type="hidden" name="MAX_FILE_SIZE" value="16000">
		<input type="hidden" name="contact1" id="contact1">
		<input type="hidden" name="sec_contact1" id="sec_contact1">
		<input type="hidden" name="father_contact1" id="father_contact1">
		<input type="hidden" name="mother_contact1" id="mother_contact1">
		<input type="hidden" name="emergency_contact1" id="emergency_contact1">
		<a id="button_at_bottom" class="disabled">Complete Part 1 to proceed</a>
		<input type="submit" name="Submit" id="Submit" disabled="disabled" value="Submit">
	</form>

	<div id="footer">
		The information collected will be held confidential and will be used solely for campus development purposes.
		<br>
		Campus Development Programme, NIT Trichy.
		<br>
		Contact : Selvendran S - 9003243401, Shrinivas Reddy - 9159660683
	</div>
	<script type="text/javascript" src="js/jquery-min.js"></script>
	<script type="text/javascript" src="js/student_db_route.js"></script>
	<script type="text/javascript" src="js/student_db_details.js"></script>
	<script type="text/javascript" src="js/intl-tel-input/build/js/intlTelInput.min.js"></script>
	<script type="text/javascript">
		$("#contact,#sec_contact,#father_contact,#mother_contact,#emergency_contact").intlTelInput({
			defaultCountry: "in",
			utilsScript: "js/intl-tel-input/lib/libphonenumber/build/utils.js"
		});
	</script>

	<?php
		$err = $GLOBALS["err"];
		echo "<script type='text/javascript'>";
			echo "var __status = " . $err . ";";
			echo "var SERVER_TODAY = new Date('" . date('Y-m-d') . "');";
		echo "</script>";
	?>
	<script type="text/javascript" src="js/student_db_validate.js"></script>
	<script type="text/javascript">
	$(".success").hide();
	function alertUser() {
		$("body")
			.animate({ "scrollTop": 0 }, "slow")
			.css("overflow", "hidden");

		$("#name").blur();
		$("#error_message")
			.show("slow")
			.on('click', function() {
				$(this).hide("slow");
				$("body").css("overflow", "auto");
				$("#name").focus();
			});
	}
	if(__status && __status.status == "error") {
		alertUser();

		for(var i = 0, key='', l = localStorage.length; i < l; i++)
		{
			key = localStorage.key(i);
			if(localStorage[key] && key != 'photo')
				$("#" + key).val( localStorage[key] );
		}
		for(var name in __status) {
			if(name == "status") continue;
			if(!__status[name]) {
				$("#succ" + name).hide();
				$("#err" + name)
					.show()
					.html(__status[name]);
			}
			else {
				$("#err" + name).hide();
				$("#succ" + name).show();
			}
		}

		$("#button_at_bottom").html("Complete Part 1 to proceed").show();
		$("#Submit").hide().attr("disabled","disabled");

		validateData(1, false);
	}
	else if(__status && __status.status == 'success') {
		for(var name in __status) {
			if(name == "status") continue;
			$("#"+name).val( __status[name] );
		}		
	}
	</script>
</body>
</html>