<?php

	echo "<h1>Venue and Movie Selection</h1>";
	echo form_open("main/validate");
	
	// Select a time.
	echo form_label("Select a date: \n");	

	$curr_timestamp = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
	
	$dateArray = array();
	for ($i = 0; $i < 13; $i++) {
		
		$curr_timestamp = mktime(0, 0, 0, date("m", $curr_timestamp),
				date("d", $curr_timestamp) + 1, date("Y", $curr_timestamp));
		
		$curr_date = date("D, M d, Y", mktime(0,0,0,date("m", $curr_timestamp),
				date("d", $curr_timestamp),date("Y", $curr_timestamp)));
		
		$dateArray[$curr_date] = $curr_date;
		
	}
	
	echo form_dropdown("Days", $dateArray);
	
	echo "<br/><br/>"; 
	
	// Select a venue.
	echo form_label("Select a venue AND/OR movie: \n");
	$theater_names = array("" => "All venues");
	$query_theater_names = $this->theater_model->get_theater_names();
	foreach ($query_theater_names->result() as $theater_name) {
		$theater_names[$theater_name->name] = $theater_name->name;
	}
	echo form_dropdown("Theaters", $theater_names);
	echo "<br></br>";

	// Select a movie.
	$movie_names = array("" => "All films");
	$query_movie_names = $this->movie_model->get_movie_names();
	foreach ($query_movie_names->result() as $movie_name) {
		$movie_names[$movie_name->title] = $movie_name->title;
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
