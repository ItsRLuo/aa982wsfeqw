
<?php

	echo form_open("main/selectTicket");
	
	
	$movie_info_str = "Movie viewings" ;
	if ($_POST["Movies"] != "") {
		$movie_info_str = $movie_info_str . " for " . $_POST["Movies"];
	}
	
	if ($_POST["Theaters"] != "") {
		$movie_info_str = $movie_info_str . " at " . $_POST["Theaters"];
	}

	$movie_info_str = $movie_info_str . " on " . $_POST["Days"];

	
	$movie_info_str = $movie_info_str . ":<br/><br/>";
	echo $movie_info_str;
	
	$viewings_array = array("None selected");
	$viewings = $this->showtime_model->get_specific_showtimes($_POST["Movies"], $_POST["Theaters"], $_POST["Days"]);

	echo "<br/><br/>";
	
	$numEntries = 0;
	foreach ($viewings->result() as $viewing) {
		// $view_string = "%s at %s (%s), on %s, %s, %s seats available";
		echo form_checkbox(array("class" => "ticketSelect checkbox"));
		printTicketInfo($viewing);
		$numEntries += 1;
		echo "<br/>";
	}
	
	echo $numEntries . " entries in total<br/>";
	
// 	echo form_dropdown("Viewings", $viewings_array, "None selected");
	
	echo "<br/>";
	echo form_submit('Select', 'Select');
	
	echo form_close();
	// echo blahfoo;
	
// 	function filterCriteria($viewings, $movie, $date, $theater) {
		
// 		$x = $this->showtime_model->get_specific_showtimes($movie, $theater, $date);
// 		foreach ($x->result() as $viewing) {
// 			// printTicketInfo($viewing);
// 		}
		
// 	}
	
	function printTicketInfo($viewing) {
		$view_string = "%s at %s (%s), on %s, at %s, %s seats available";
		echo sprintf($view_string, $viewing->title, $viewing->name, $viewing->address,
									$viewing->date, $viewing->time, $viewing->available) . "<br/>";
	}
	
?>