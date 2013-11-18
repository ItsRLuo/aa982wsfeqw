<div id="information">
<?php
	/*
	 * This is the input page for user's information(credit card,name,expire date of credit card, etc)
	 * After the user sumbits, it goes to the final summary page
	 */	

	echo '<script type="text/javascript" src="' . base_url() . 'js/useinformation.js"></script>';
	$this->load->helper("form");
	
	echo validation_errors(); #Display validation error information
	
	echo "<script></script>";
	echo "<h1>Payment</h1>";
	
	echo form_open("main/overview"); #Goes to the summary page after the user sumbits
	$date = 0;
	
	echo form_label("firstname","firstname");
	
	/*
	 * input variables are stored in the array for different form_inputs
	 */
	$data = array(
			"name" => "firstname",
			"id"   => "firstname",
			"value" => "");
	echo form_input($data);
	
	echo form_label("lastname","lastname");
	$data = array(
			"name" => "lastname",
			"id"   => "lastname",
			"value" => ""
			);
	echo form_input($data);
	
	echo form_label("credit (Must be all numbers and 16 characters long)","credit");
	$data = array(
			"name" => "credit",
			"id"   => "credit",
			"value" => "",
			'maxlength' =>  "16"
	);
	echo form_input($data);
	
	echo form_label("Credit card expiring date (Example YY/MM)","date");
	$data = array(
			"name" => "date",
			"id"   => "date",
			"value" => "",
			'style' => "width:10%",
			'maxlength' =>  "5"
	);
	echo form_input($data);
	
	echo form_submit('submit', 'submit');
	echo form_close();

?>
</div>
