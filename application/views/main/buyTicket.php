<?php

	
	echo form_open("main/validate");
	
	// Select a time.
	echo form_label("Select a date: \n");	
	
	
// 	echo form_input("Month");
// 	echo form_input("Day");
// 	echo form_input("Year"
	
	echo form_dropdown('Month', $this->months, "Select a month", array("id" => "monthDropdown"));
	echo form_dropdown('Day', $this->day, "Select a day", array("id" => "dayDropdown"));
	echo form_dropdown('Year', $this->year, "Select a year", array("id" => "yearDropdown"));
	echo "<br></br>";
	
	// Select a venue.
	echo form_label("Select a venue AND/OR movie: \n");
	$theater_names = array("All venues");
	$query_theater_names = $this->theater_model->get_theater_names();
	foreach ($query_theater_names->result() as $theater_name) {
		array_push($theater_names, $theater_name->name);
	}
	echo form_dropdown("Theaters", $theater_names);
// 	echo form_input("Theaters");
	echo "<br></br>";

	// Select a movie.
	$movie_names = array("All films");
	$query_movie_names = $this->movie_model->get_movie_names();
	foreach ($query_movie_names->result() as $movie_name) {
		array_push($movie_names, $movie_name->title);
	}
	echo form_dropdown("Movies", $movie_names);	
// 	echo form_input("Movies");
	echo "<br></br>";
	
	// Find a movie!
	echo form_submit('Search for Movie', 'Search for Movie');
	
	
	echo form_close();
	
	
// echo form_open("main/buyTicket");
// 


?>