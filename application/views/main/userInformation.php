<div id="information">
<?php
	echo '<script type="text/javascript" src="' . base_url() . 'js/useinformation.js"></script>';
	$this->load->helper("form");
	
	
	echo validation_errors();
	echo "<script></script>";
	echo "<h1>Payment</h1>";
	$credit_card = 0;
	
	echo form_open("main/overview","123");
	
	$date = 0;
	echo form_label("firstname","firstname");
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


<script>
$(document).ready(function() {
	$("#filterCriteria").click(function() {
		if ($("#theaterList").val() == "" && $("#movieList").val() == "") {
			document.getElementById("theaterList").setCustomValidity("Select either a movie or a theater");
			document.getElementById("movieList").setCustomValidity("Select either a movie or a theater");
			return false;
		} else {
			document.getElementById("theaterList").setCustomValidity("");
			document.getElementById("movieList").setCustomValidity("");
			return true;
		}
	});
});

</script>