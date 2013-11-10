<?php
	echo $this->months[$_REQUEST["Month"]];
	echo $this->day[$_REQUEST["Day"]];
	echo $this->year[$_REQUEST["Year"]];
	
	echo "Select a movie viewing: ";

	$viewings_array = array("None selected");
	$viewings = $this->showtime_model->get_showtimes();
	
	foreach ($viewings->result() as $viewing) {
		$view_string = "%s at %s (%s), on %s, %s, %s seats available";
		array_push($viewings_array, sprintf($view_string, $viewing->title, $viewing->name, $viewing->address,
											$viewing->date, $viewing->time, $viewing->available));
	}
	
	echo form_open("main/selectTicket");
	echo form_dropdown("Viewings", $viewings_array, "None selected");
	
	echo form_submit('Select', 'Select');
	
	echo form_close();
	
	
?>