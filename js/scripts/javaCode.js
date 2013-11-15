$(document).ready(function() {
	
	// Ensure only one checkbox is selected.
	$("input:checkbox").change(function() {
		$("input:checkbox").not(this).prop("checked", false);
	});
	
	// Ensure that at least one movie or theater is selected.
	// $("#filterCriteria").bind('onclick', checkInputFields);

	// Ensure that at least one movie or theater is selected.
	// $("#filterCriteria").bind('input', checkInputFields);
	//document.getElementById("theaterList").setCustomValidity("Select either a movie or a theater");
	
	document.getElementById("filterCriteria").oninput = function() {
		if ($("#theaterList").val() == "" && $("#movieList").val() == "") {
			document.getElementById("theaterList").setCustomValidity("Select either a movie or a theater");
			document.getElementById("movieList").setCustomValidity("Select either a movie or a theater");
			return false;
		} else {
			document.getElementById("theaterList").setCustomValidity("");
			document.getElementById("movieList").setCustomValidity("");
			return true;
		}
	};
	
	
//	{
//	
//	click(function() {
//		if ($("#theaterList").val() == "" 
//			&& $("#movieList").val() == "") {
//			document.getElementById("empty_form_error_2").setCustomValidity("Select either a movie or a theater");
//			
//		} else {
//			document.getElementById("empty_form_error_2").setCustomValidity("");
//		}
//		
//		console.log(document.getElementById("empty_form_error_2").validationMessage);
//		
//	});
	
});

function checkInputFields() {
	if ($("#theaterList").val() == "" && $("#movieList").val() == "") {
		document.getElementById("theaterList").setCustomValidity("Select either a movie or a theater");
		return false;
	} else {
		document.getElementById("theaterList").setCustomValidity("");
		return true;
	}
};