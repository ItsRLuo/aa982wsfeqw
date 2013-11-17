<?php
	$this->load->helper("form");
	$fname = $this->input->post('firstname');
	$lname = $this->input->post('lastname');
	$credit = $this->input->post('credit');
	echo "User: ".$fname ." ". $lname. "<br/>"; 
	echo "Credit Card: ".$credit. "<br/>";
	echo "Movie Name: ".$x->title . "<br/>";
	echo "Movie Threater: ".$x->name . "<br/>";
	echo "Movie Address: ".$x->address . "<br/>";
	echo "Date: ".$x->date . "<br/>";
	echo "Time: ".$x->time . "<br/>";
	echo "Available seats: ".$x->available . "<br/>";
	echo "<br/>";
?>


<!DOCTYPE html>
<html>
<body>
<p></p>
<button onclick="printing()">Print this page</button>
<script>

function printing()
{
	window.print();
}
</script>

</body>
</html>

<a href="index"> <img id="Icon" src="images/Logo.jpg" alt = "return" style="position:fixed right:5px; bottom:5px; size :20;"/> </a>