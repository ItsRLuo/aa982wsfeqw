<?php
	$this->load->helper("form");
	$fname = $this->input->post('firstname');
	$lname = $this->input->post('lastname');
	$credit = $this->input->post('credit');

	echo "<h1>Summary:</h1>";
	echo "User: ". $fname ." ". $lname . "<br/>"; 
	echo "Credit Card: ". $credit. "<br/>";
	echo "Movie Name: ". $x->title . "<br/>";
	echo "Movie Threater: ".$x->name . "<br/>";
	echo "Movie Address: ".$x->address . "<br/>";
	echo "Date: ".$x->date . "<br/>";
	echo "Time: ".$x->time . "<br/>";
	echo "Available seats: ".$x->available . "<br/>";
	echo "<br/>";
	echo "<button onclick='printing()'>Print this page</button>";
	echo '<a href="index"><img id="Icon" src="images/a.png" alt="return" class="backtext"/></a>';
	
?>
<script>
function printing()
{
	window.print();
}
</script>
