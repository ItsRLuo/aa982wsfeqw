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
	echo form_label("Select a venue: \n");
	echo form_dropdown("Theaters", $theater_names);
	echo "<br></br>";

	// Select a movie.
	echo form_label("--OR--<br/><br/>Select a movie: \n");	
	echo form_dropdown("Movies", $movie_names);
	echo "<br></br>";
	
	// Find a movie!
	echo form_submit('Search for Movie', 'Search for Movie');
	echo form_close();
	
?>
