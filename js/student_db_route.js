/* routing between the form parts */

var _part2 = false,
	_part3 = false;

function error_exists() {
	for(var k in __status) return true;
	return false;
}

function route() {
	var hash = window.location.hash || "";

	var match = hash.match(/^(#part\d)(&focus=([^&=]*))?$/);
	var hash = match && match[1];
	var elem_to_focus = match && match[3];

	$('body').animate({
		scrollTop: 0
	});
	if(hash == "#part3") {
		if(_part3) {
			$(".page").hide().filter("#page3").show();
			$("#button_at_bottom")
					.addClass("disabled")
					.attr("href", "")
					.html("Complete Part 3 to proceed");

			$("#father_name").focus();
		}
		else {
			window.location.hash = "#part2";
		}
	}
	else if(hash == "#part2") {
		if(_part2) {
			$(".page").hide().filter("#page2").show();
			$("#button_at_bottom")
					.addClass("disabled")
					.attr("href", "")
					.html("Complete Part 2 to proceed");

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

	if(elem_to_focus)
		$("#" + elem_to_focus).focus();
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

$("#frm").on("submit", function() {
	var elem_to_focus = null;
	function focus(id) {
		elem_to_focus = id;
	}
	if(!validateData(1,false, focus))
	{
		window.location.hash = "#part1&focus=" + elem_to_focus;
		return false;
	}
	if(!validateData(2,false, focus))
	{
		window.location.hash = "#part2&focus=" + elem_to_focus;
		return false;
	}
	if(!validateData(3,false, focus))
	{
		window.location.hash = "#part3&focus=" + elem_to_focus;
		return false;
	}
	return true;
});