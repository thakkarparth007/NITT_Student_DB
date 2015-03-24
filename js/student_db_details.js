var part1 = [
{
	name: "name",
	readable_name: "Name",
	type: "text",
	required: true,
	rule: function(s) {
		if(s.length > 50) 				return "Name can not exceed 50 characters";
		if(!/^[a-zA-Z \.']+$/.test(s)) 	return "Enter a valid name";
		return false;
	}
},
{
	name: "roll",
	readable_name: "Roll Number",
	type: "text",
	required: true,
	rule: function(s) {
		if(!/^\d{9}$/.test(s))			return "Enter a valid roll number";

		return false;
	}
},
{
	name: "course",
	readable_name: "Course",
	type: "text",
	required: true,
	rule: function(s) {
		if(!/^B\.Tech|B\.Arch|M\.Tech|MCA|MBA|MS|Phd$/.test(s))
										return "Choose a valid course";

		return false;
	}
},
{
	name: "dept",
	readable_name: "Department",
	type: "text",
	required: true,
	rule: function(s) {
		var re = /^Architecture|Chemical Engineering|Chemistry|Civil Engineering|Computer Applications|Computer Science And Engineering|Electrical And Electronics Engineering|Electronics And Communication Engineering|Humanities|Instrumentation And Control Engineering|Mathematics|Management Studies|Mechanical Engineering|Metallurgy and Materials Science Engineering|Physics|Production Engineering$/;
		if(!re.test(s))
										return "Choose a valid department";

		return false;
	}
},
{
	name: "dob",
	readable_name: "Date of birth",
	type: "date",
	required: true,
	rule: function(s) {
		var match = s.match(/^(\d\d\d\d)-\d\d-\d\d$/);
		if(!match || match.length < 2)
			return "Enter a valid date of birth";

		var yr = parseInt( match[1] );
		if(!yr) return "Enter a valid date of birth";
		if(yr < 1930)
			return "Enter a valid date of birth";
		// the person must be at least 17 years old to be a student
		var server_year = SERVER_TODAY.getFullYear();
		if(yr > server_year - 17)
			return "Enter a valid date of birth";
		return false;
	}
},
{
	name: "hostel",
	readable_name: "Hostel data",
	type: "text",
	required: true,
	rule: function(hostel) {
		var room_error = false;
		var hostel_error = false;
		if(!/^\d+$/.test(hostel.roomno))	room_error = true;;
		var re = /^Coral|Agate|Diamond|Jade|Zircon A|Zircon B|Zircon C|Garnet A|Garnet B|Garnet C|Amber A|Amber B|Perl|Ruby|Sapphire|Emerald|Topaz|Aquamarine A|Aquamarine B|Jasper|Opal A|Opal B|Opal C|Opal D|Opal E$/;
		if(!re.test(hostel.name))			hostel_error = true;
		
		var err = "Enter a valid";
		if(hostel_error && room_error)
			err += " room number and hostel";
		else if(hostel_error)
			err += " hostel";
		else if(room_error)
			err += " room number";
		else
			return false;

		return err;
	}
},
{
	name: "photo",
	readable_name: "Photo",
	type: "file",
	required: true,
	rule: function(s) {
		// ??
		
		return false;
	}
}
];


var part2 = [
{
	name: "email",
	readable_name: "Email",
	type: "email",
	required: true,
	rule: function(s) {
		if(!/^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(s))
			return "Enter a valid email id";
		return false;
	}
},
{
	name: "contact",
	readable_name: "Contact",
	type: "tel",
	required: true,
	rule: function(s) {
		if(!/^[0\+]\d{12,13}$/.test(s))		return "Enter a valid mobile number";

		return false;
	}
},
{
	name: "sec_contact",
	readable_name: "Secondary Contact",
	type: "tel",
	required: false,
	rule: function(s) {
		if(!/^[0\+]\d{12,13}$/.test(s))		return "Enter a valid mobile number";

		return false;
	}
},
{
	name: "curr_addr1",
	readable_name: "Address Line 1",
	type: "text",
	required: true,
	rule: function(s) {
		if(s == "")
			return "Address Line 1 is required";
		return false;
	}
},
{
	name: "curr_addr2",
	readable_name: "Address Line 2",
	type: "text",
	required: true,
	rule: function(s) {
		if(s == "")
			return "Address Line 2 is required";
		return false;
	}
},
{
	name: "curr_addr3",
	readable_name: "City",
	type: "text",
	required: true,
	rule: function(s) {
		if(s == "")
			return "City name is required";
		return false;
	}
},
{
	name: "curr_addr4",
	readable_name: "State",
	type: "text",
	required: true,
	rule: function(s) {
		if(s == "")
			return "State name is required";
		return false;
	}
},
{
	name: "curr_addr5",
	readable_name: "ZIP Code",
	type: "text",
	required: true,
	rule: function(s) {
		if(s == "")
			return "ZIP Code is required";
		return false;
	}
},
{
	name: "curr_country",
	readable_name: "Country",
	type: "text",
	required: true,
	rule: function(s) {
		if(s == "")
			return "Country name is required";
		return false;
	}
},
{
	name: "india_addr1",
	readable_name: "Address Line 1",
	type: "text",
	required: true,
	rule: function(s) {
		if(s == "")
			return "Address Line 1 is required";
		return false;
	}
},
{
	name: "india_addr2",
	readable_name: "Address Line 2",
	type: "text",
	required: true,
	rule: function(s) {
		if(s == "")
			return "Address Line 2 is required";
		return false;
	}
},
{
	name: "india_addr3",
	readable_name: "City",
	type: "text",
	required: true,
	rule: function(s) {
		if(s == "")
			return "City name is required";
		return false;
	}
},
{
	name: "india_addr4",
	readable_name: "State",
	type: "text",
	required: true,
	rule: function(s) {
		if(s == "")
			return "State name is required";
		return false;
	}
},
{
	name: "india_addr5",
	readable_name: "ZIP Code",
	type: "text",
	required: true,
	rule: function(s) {
		if(s == "")
			return "ZIP Code is required";
		return false;
	}
},
{
	name: "nationality",
	readable_name: "Nationality",
	type: "text",
	required: true,
	rule: function(s) {
		// ??
		
		return false;
	}
}
];

var part3 = [
{
	name: "father_name",
	readable_name: "Father's Name",
	type: "text",
	required: true,
	rule: function(s) {
		if(s.length > 50) 				return "Name can not exceed 50 characters";
		if(!/^[a-zA-Z \.']+$/.test(s)) 	return "Enter a valid name";
		return false;
	}
},
{
	name: "father_email",
	readable_name: "Father's Email",
	type: "email",
	required: true,
	rule: function(s) {
		if(!/^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(s))
			return "Enter a valid email id";
		return false;
	}
},
{
	name: "father_contact",
	readable_name: "Father's Contact",
	type: "tel",
	required: true,
	rule: function(s) {
		if(!/^[0\+]\d{12,13}$/.test(s))		return "Enter a valid mobile number";

		return false;
	}
},
{
	name: "mother_name",
	readable_name: "Mother's Name",
	type: "text",
	required: true,
	rule: function(s) {
		if(s.length > 50) 				return "Name can not exceed 50 characters";
		if(!/^[a-zA-Z \.']+$/.test(s)) 	return "Enter a valid name";
		return false;
	}
},
{
	name: "mother_email",
	readable_name: "Mother's Email",
	type: "email",
	required: true,
	rule: function(s) {
		if(!/^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(s))
			return "Enter a valid email id";
		return false;
	}
},
{
	name: "mother_contact",
	readable_name: "Mother's Contact",
	type: "tel",
	required: true,
	rule: function(s) {
		if(!/^[0\+]\d{12,13}$/.test(s))		return "Enter a valid mobile number";

		return false;
	}
},
{
	name: "emergency_name",
	readable_name: "Emergency Contact's Name",
	type: "text",
	required: true,
	rule: function(s) {
		if(s.length > 50) 				return "Name can not exceed 50 characters";
		if(!/^[a-zA-Z \.']+$/.test(s)) 	return "Enter a valid name";
		return false;
	}
},
{
	name: "emergency_relation",
	readable_name: "Emergency Contact's Relation",
	type: "text",
	required: true,
	rule: function(s) {
		
		return false;
	}
},
{
	name: "emergency_contact",
	readable_name: "Emergency Contact Number",
	type: "tel",
	required: true,
	rule: function(s) {
		if(!/^[0\+]\d{12,13}$/.test(s))		return "Enter a valid mobile number";

		return false;
	}
},
{
	name: "bloodgrp",
	readable_name: "Blood Group",
	type: "text",
	required: true,
	rule: function(bloodgrp) {
		var re = /^A\+|A\-|O\+|O\-|B\+|B\-|AB\+|AB\-|A1\+|A1\-|A2\+|A2\-|A1B\+|A1B\-|A2B\+|A2B\-|B1\+$/;
		if(!re.test(bloodgrp))			return "Enter a valid blood group";
		
		return false;
	}
},
{
	name: "donate",
	readable_name: "Willingness to donate blood",
	type: "text",
	required: true,
	rule: function(s) {
		if(s.toLowerCase() != "yes" && s.toLowerCase() != "no")
			return "Please tell if you are willing to donate blood";
		return false;
	}
}
];

