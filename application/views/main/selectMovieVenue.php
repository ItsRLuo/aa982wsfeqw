<?php
	/* 
	 * This page is to select the movies and theater the user wants to goto
	 */

	echo '<script type="text/javascript" src="' . base_url() . 'js/selectMovieVenue.js"></script>';
	echo "<h1>Venue and Movie Selection</h1>";
	echo form_open("main/validate");
	
	// Select a time.
	echo form_label("Select a date: \n");
	echo form_dropdown("Days", $dateArray, set_value("Days"));
	echo "<br/><br/>"; 
	
	// Select a venue.
	
	// Indicate if neither a movie NOR a theater was selected.
	echo form_error("Movies", "<p id='empty_form_error'>", "</p>");
	echo form_label("Select a venue AND/OR movie: \n");

	echo form_dropdown("Theaters", $theater_names, set_value("Theaters"), 'id = "theaterList"');
	echo "<br></br>";

	echo form_dropdown("Movies", $movie_names, set_value("Movies"), 'id = "movieList"');	
	echo "<br></br>";
	
	// Find a movie!
	echo form_submit(array("name" => 'Search for movie', 
							"value" => 'Search for movie', 
							'id' => 'filterCriteria'));
	
	echo form_close();
	

?>
<script>
$(document).ready(function() {
	$("#filterCriteria").click(function() {
		if ($("#theaterList").val() == "" && $("#movieList").val() == "") {
			document.getElementById("theaterList").setCustomValidity("Select either a movie or a theater");
			document.getElementById("movieList").setCustomValidity("Select either a movie or a theater");
			return false;
		} else {
			document.getElementById("theaterList").setCustomValidity("");
			document.getElementById("movieList").setCustomValidity("");
			return true;
		}
	});
});

</script>