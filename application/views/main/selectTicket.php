
<?php

	echo form_open("main/selectSeat");
 	echo $movieInfoStr;

	
	$numEntries = 0;
	foreach ($viewings->result() as $viewing) {
		$ticketInfo = getTicketInfo($viewing);
		echo form_checkbox(array("name" => "checkMe", "class" => "ticketSelect checkbox", 
								  "value" => $numEntries));
		echo $ticketInfo . "<br/>";
		$numEntries += 1;
	}

	echo $numEntries . " entries in total<br/>";

	echo "<br/>";
	echo form_submit('Select', 'Select');

	echo anchor('main/userInformation', 'Selects ') . "<br />";

	
	function getTicketInfo($viewing) {
		$view_string = "%s at %s (%s), on %s, at %s, %s seats available";
		return sprintf($view_string, $viewing->title, $viewing->name, $viewing->address,
				$viewing->date, $viewing->time, $viewing->available) . "<br/>";
	}
	
?>