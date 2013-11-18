<?php
	$this->load->helper("form");
	$fname = $this->input->post('firstname');
	$lname = $this->input->post('lastname');
	$credit = $this->input->post('credit');
	$expire = $this->input->post('date');

	
	echo "<h1>Summary:</h1>";
	echo "User: ". $fname ." ". $lname . "<br/>"; 
	echo "Credit Card: ". $credit. "<br/>";
	echo "Movie Name: ". $x->title . "<br/>";
	echo "Movie Threater: ".$x->name . "<br/>";
	echo "Movie Address: ".$x->address . "<br/>";
	echo "Date: ".$x->date . "<br/>";
	echo "Time: ".$x->time . "<br/>";
	$numSeats = $x->available;
	$numSeats = $numSeats - 1;
	echo "Available seats: ".$numSeats. "<br/>";
	$posSeats = "";
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
	echo "<button onclick='printing()'>Print this page</button>";
	echo '<a href="index"><img id="Icon" src="images/a.png" alt="return" class="backtext"/></a>';
	echo "<br />";
	echo anchor('main/index', 'Return') . "<br />";

	//$data = array(
	//		'ticket' => 1000,
	//		'first' => $fname,
	//		'last' => $lname,
	//		'creditcardnumber' => $credit,
	//		'creditcardexpiration' => "1234",
	//		'showtime_id'   =>  2,
	//		'seat'  =>  1
	//);
	
	//$this->db->insert('ticket', $data);
	//echo $this->db->last_query();
	//echo $this->db->countall(Ticket_model);
?>
<script>
function printing()
{
	window.print();
}
</script>
