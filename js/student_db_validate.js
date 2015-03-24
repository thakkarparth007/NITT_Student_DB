/*
var form1 = $("#frm1");
form1.on("submit", validateData);
*/

var part1_valid = {},
	part2_valid = {},
	part3_valid = {};

function get_part_valid_object(part) {
	return part == 1 ? part1_valid 
					 : part == 2 ? part2_valid
					 			 : part3_valid;
}

function get_part_obj(part) {
	return part == 1 ? part1 
					 : part == 2 ? part2
					 			 : part3;	
}
function validateData(part, silent) {
	var error = false;
	var part_obj = get_part_obj(part);
	var part_valid = get_part_valid_object(part);

	silent = silent === undefined ? true : silent;

	for(var i in part_obj) {
		validate(part, part_obj[i], silent);
		if(!part_valid[ part_obj[i].name ])
			error = true;
	}

	return !error;
}

function validate(part, field, silent) {
	var name = field.name,
		r_name = field.readable_name,
		$field = $("#" + name);
	
	var part_obj = get_part_obj(part);
	var part_valid = get_part_valid_object(part);
	
	tmp = (/contact/.test(name) ? $field.intlTelInput("getNumber")
								: $field.val());

	var m = name.match(/^.*contact$/);
	if(m && m[0])
		$("#" + m[0] + "1").val( $field.intlTelInput("getNumber") );
	/*if(name == 'contact')
		$("#contact1").val( $field.intlTelInput("getNumber") );
	if(name == 'sec_contact')
		$("#sec_contact1").val( $field.intlTelInput("getNumber") );*/
	if(name == 'hostel')
		tmp = {
			roomno: $("#roomno").val(),
			name: $field.val()
		};

	if(field.required && !tmp) {
		if(!silent) {
			$("#succ" + name).hide();
			
			$("#err" + name)
				.show()
				.html("This data is required");
		}
		part_valid[name] = 0;
	}
	else if(field.rule(tmp)) {
		if(!silent) {
			$("#succ" + name).hide();

			$("#err" + name)
				.show()
				.html(field.rule(tmp));
		}

		part_valid[name] = 0;
	}
	else {
		if(!silent) {
			$("#err" + name).hide();
			$("#succ" + name).show();
		}

		part_valid[name] = 1;
	}

	// store the data ----if set----, in the localStorage.
	if(name == "hostel") {
		localStorage['roomno'] = tmp.roomno;
		localStorage['hostel'] = tmp.name;
	}
	else if (m = name.match(/^.*contact$/)) {
		localStorage[m[0]] = $field.intlTelInput("getNumber");
	}
	else
		localStorage[name] = tmp;

	if(!silent && part_valid[name] && validateData(part))
	{
		// mark everything as valid, and activate the next part
		for(var i in part_obj) {
			$("#err" + part_obj[i].name).hide();
			$("#succ" + part_obj[i].name).show();
				error = true;
		}
		activatePart(part + 1);
	}
}

$("#contact").on("blur change", function() {
	var countryData = $(this).intlTelInput("getSelectedCountryData");
	var countryName = countryData.name.match(/^([^\s]+) /)[1];

	$("#curr_country").val( countryName ).change();
})

$("#curr_country").on("blur change", function() {
	if(this.value.toLowerCase() == "india")
	{
		$("#p_india_addr,#p_india_addr_label,#hr_following_india_addr").hide();
		$("#india_addr1").val( $("#curr_addr1").val() );
		$("#india_addr2").val( $("#curr_addr2").val() );
		$("#india_addr3").val( $("#curr_addr3").val() );
		$("#india_addr4").val( $("#curr_addr4").val() );
		$("#india_addr5").val( $("#curr_addr5").val() );
		$("#nationality").val("Indian");
	}
	else {
		$("#p_india_addr,#p_india_addr_label,#hr_following_india_addr").show();
		$("#india_addr1").val("").focus();
		$("#india_addr2").val("");
		$("#india_addr3").val("")
		$("#india_addr4").val("")
		$("#india_addr5").val("")
		$("#nationality").val("");
	}
});

for(var k = 1; k < 4; k++) {
	var part_obj = get_part_obj(k);

	for(var i in part_obj) {
		( function(k, i) { 
			var o = part_obj[i],
				name = o.name,
				r_name = o.readable_name,
				$field = $("#" + name);

			$field.on("change blur", function(e) {
				validate(k, o);
			});

		})(k, i);
	}
}