/* routing between the form parts */

var _part2 = false,
	_part3 = false;

function error_exists() {
	for(var k in __status) return true;
	return false;
}

function route() {
	var hash = window.location.hash || "";

	if(hash == "#part3") {
		if(_part3) {
			$(".page").hide().filter("#page3").show();
			//if(error_exists())
			//	validateData(3, false);

			$("#father_name").focus();
		}
		else {
			window.location.hash = "#part2";
		}
	}
	else if(hash == "#part2") {
		if(_part2) {
			$(".page").hide().filter("#page2").show();
			//if(error_exists())
			//	validateData(2, false);

			$("#email").focus();
		}
		else {
			window.location.hash = "#part1";
		}
	}
	else if(hash == "#part1" || hash == "") {
		$(".page").hide().filter("#page1").show();
		$("#name").focus();
	}
	else {
		window.location.hash = "#part1";
	}
}

function activatePart(x) {
	if(x == 2) {
		_part2 = true;
		$("#link_p2").addClass("active");
		$("#button_at_bottom")
			.removeClass("disabled")
			.attr("href", "#part2")
			.html("Proceed to part 2")
			.click(function() {
				$(this)
					.addClass("disabled")
					.attr("href", "")
					.html("Complete Part 2 to proceed");
				window.location.hash = "#part2";
				return false;
			});
		//validateData(2,false);
	}
	if(x == 3) {
		if(!_part2) return false;
		_part3 = true;
		$("#link_p3").addClass("active");
		$("#button_at_bottom")
			.removeClass("disabled")
			.attr("href", "#part3")
			.html("Proceed to part 3")
			.click(function() {
				$(this)
					.addClass("disabled")
					.attr("href", "")
					.html("Complete Part 3 to finish");
				window.location.hash = "#part3";
				return false;
			});
		//validateData(3, false);
	}
	if(x == 4) {
		if(!_part3) return false;
		activateSubmit();
	}
}

function activateSubmit() {
	$("#button_at_bottom").hide();
	$("#Submit").show().removeAttr("disabled");
}

$(window).on("hashchange", route);

route();
$("#Submit").hide();