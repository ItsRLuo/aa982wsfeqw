<?php

	echo "<h1>Payment</h1>";
	echo $this->ticket_model->get_tickets()->result();
	echo form_open("main/index");
	$credit_card = 0;
	$date = 0;
	$Account = "";
	$Password = "";
	echo "Account:";
	echo form_input($Account,"enter");
	echo "Password:";
	echo form_password($Password,"enter");
	echo "Credit card number";
	echo form_input($credit_card,"enter");
	echo "<br></br>";
	echo "Expiration date Example MM/YY";
	echo form_input($date, "enter");
	echo "<br></br>";
	echo form_submit('submit', 'submit');
	echo form_close();

?>
