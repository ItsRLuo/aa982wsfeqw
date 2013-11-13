<?php

	echo "<h1>Venue and Movie Selection</h1>";
	echo form_open("main/validate");
	
	// Select a time.
	echo form_label("Select a date: \n");	

	echo form_dropdown("Days", $dateArray);
	
	echo "<br/><br/>"; 
	
	// Select a venue.
	
	// Indicate if neither a movie NOR a theater was selected.
	echo form_error("Movies");
	echo form_label("Select a venue AND/OR movie: \n");

	echo form_dropdown("Theaters", $theater_names);
	echo "<br></br>";

	echo form_dropdown("Movies", $movie_names);	
	echo "<br></br>";
	
	// Find a movie!
	echo form_submit('Search for movie', 'Search for movie');
	
	echo form_close();
	

?>
