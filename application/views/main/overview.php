<?php
	/*
	 * This is the summmary page when the user finish buying tickets
	 * This page shows all the information of the purchase and can be printable
	 */
	$this->load->helper("form");
	$fname = $this->input->post('firstname');
	$lname = $this->input->post('lastname');
	$credit = $this->input->post('credit');
	$expire = $this->input->post('date');

	#Display everything
	echo "<h1>Summary:</h1>";
	echo "User: ". $fname ." ". $lname . "<br/>"; 
	echo "Credit Card: ". $credit. "<br/>";
	echo "Movie Name: ". $x->title . "<br/>";
	echo "Movie Threater: ".$x->name . "<br/>";
	echo "Movie Address: ".$x->address . "<br/>";
	echo "Date: ".$x->date . "<br/>";
	echo "Time: ".$x->time . "<br/>";
	
	#The number of seats is always 1 lower
	$numSeats = $x->available;
	$numSeats = $numSeats - 1;
	echo "Available seats: ".$numSeats. "<br/>";
	$posSeats = "";
	echo $_SESSION["seatNo"];
	if ($_SESSION["seatNo"] == 1){
		$posSeats = "Left";
	}
	if ($_SESSION["seatNo"] == 2){
		$posSeats = "Middle";
	}
	if ($_SESSION["seatNo"] == 3){
		$posSeats = "Right";
	}
	echo "Position of the seat: ".$posSeats."<br/>";
	echo "<br/>";
	#A button for printing
	echo "<button onclick='printing()'>Print this page</button>";
	echo "<br />";
	#A button for returning to the main page
	echo anchor('main/index', 'Return') . "<br />";

?>
<script>
function printing()
{
	window.print();
}
</script>
